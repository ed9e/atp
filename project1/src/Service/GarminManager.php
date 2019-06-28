<?php


namespace App\Service;


use App\Entity\GarminActivity;
use App\Entity\GarminActivityDetails;
use App\Garmin\Stock\Request\Calendar;
use App\Mapper\Entity\GarminEntityMapper as Mapper;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;

class GarminManager
{
    protected $entityManager;
    protected $mapper;
    protected $activityDetailsService;
    protected $garminCalendar;

    /**
     * @return Calendar
     */
    public function getGarminCalendar(): Calendar
    {
        return $this->garminCalendar;
    }

    /**
     * @param Calendar $garminCalendar
     * @return GarminManager
     */
    public function setGarminCalendar(Calendar $garminCalendar): GarminManager
    {
        $this->garminCalendar = $garminCalendar;
        return $this;
    }


    public function __construct(EntityManagerInterface $entityManager, Mapper $mapper, GarminActivityDetailsManager $activityDetailsService)
    {
        $this->entityManager = $entityManager;
        $this->mapper = $mapper;
        $this->activityDetailsService = $activityDetailsService;
        $this->garminCalendar = new Calendar();
    }

    /**
     * @return int|null
     */
    public function importCalendar()
    {
        $this->getGarminCalendar()->fetch();

        foreach ($this->getGarminCalendar()->getCalendarItems() as $item) {
            $activity = new GarminActivity();
            $this->mapper->mapDataToObject($item, $activity);

            if($activity->getItemType() == 'activity') {
                $this->activityDetailsService->setActivityId($activity->getGarminId());
                $this->activityDetailsService->import();
            }

            $this->entityManager->merge($activity);

        }

        $this->entityManager->flush();

        return null;
    }
}