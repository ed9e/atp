<?php


namespace App\Service;


use App\Entity\GarminActivity;
use App\Garmin\Stock\Calendar;
use App\Mapper\Entity\GarminEntityMapper as Mapper;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;

class GarminManager
{
    protected $entityManager;
    protected $mapper;
    protected $logger;

    public function __construct(EntityManagerInterface $entityManager, Mapper $mapper, LoggerInterface $logger)
    {
        $this->entityManager = $entityManager;
        $this->mapper = $mapper;
        $this->logger = $logger;
    }

    /**
     * @return int|null
     */
    public function importCalendar()
    {
        $garminCalendar = new Calendar();
        $garminCalendar->fetch();
        $this->logger->info(print_r($garminCalendar->getCalendarItems(), true));

        foreach ($garminCalendar->getCalendarItems() as $item) {
            $activity = new GarminActivity();
            $this->mapper->mapDataToObject($item, $activity);

            $this->entityManager->merge($activity);

        }

        $this->entityManager->flush();

        return null;
    }
}