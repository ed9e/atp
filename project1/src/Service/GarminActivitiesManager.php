<?php


namespace App\Service;


use App\Entity\GarminActivityDetails;
use App\Garmin\Stock\Request\Activities\AbstractActivities;
use App\Garmin\Stock\Request\Activities\ByCurrentUser;
use App\Garmin\Stock\Request\Activities\ByUserDisplayName;
use App\Garmin\Stock\ResponseMap\Activity;
use App\Mapper\Entity\GarminActivityDetailsEntityMapper as Mapper;
use Doctrine\ORM\EntityManagerInterface;

class GarminActivitiesManager
{
    protected $entityManager;
    protected $mapper;
    protected $responseMapper;
    protected $request;
    protected $activityId;
    protected $userDisplayName;
    protected $running;
    protected $sleepTime = 5 * 60;

    public function __construct(EntityManagerInterface $entityManager, Mapper $mapper, Activity $responseMapper)
    {
        $this->entityManager = $entityManager;
        $this->mapper = $mapper;

        $this->responseMapper = $responseMapper;
    }

    public function run(): void
    {
        $i = 0;
        $this->running = 1;
        while ($this->getRunning() > 0) {
            $this->import();
            $i++;
            dump($i);
            sleep($this->sleepTime);
        }
    }

    /**
     * @return mixed
     */
    public function getRunning()
    {
        return $this->running;
    }

    /**
     * @param mixed $running
     * @return GarminActivitiesManager
     */
    public function setRunning($running)
    {
        $this->running = $running;
        return $this;
    }

    public function import(): void
    {
        $this->getRequest()->fetch();
        $activity = new GarminActivityDetails();

        $this->mapper->setResponseMapper($this->responseMapper);

        foreach ($this->getRequest()->response() as $item) {
            $this->mapper->mapDataToObject($item, $activity);
            $this->entityManager->merge($activity);

        }
        $this->entityManager->flush();
    }

    public function clearRequest()
    {
        $this->request = null;
        return $this;
    }
    public function getRequest(): AbstractActivities
    {
        if (!$this->request) {
            if (null !== $this->getUserDisplayName()) {
                dump('By user display name');
                $this->request = new ByUserDisplayName();
                $this->request->setUserDisplayName($this->getUserDisplayName());
            } else {
                $this->request = new ByCurrentUser();
                dump('By current user');
            }
        }
        return $this->request;
    }

    /**
     * @return string
     */
    public function getUserDisplayName(): ?string
    {
        return $this->userDisplayName;
    }

    /**
     * @param string $userDisplayName
     * @return GarminActivitiesManager
     */
    public function setUserDisplayName(string $userDisplayName): GarminActivitiesManager
    {
        $this->userDisplayName = $userDisplayName;
        return $this;
    }

    public function getMap()
    {
        return $this->responseMapper->getMap();
    }

    public function setActivityId($id): void
    {
        $this->activityId = $id;
    }
}