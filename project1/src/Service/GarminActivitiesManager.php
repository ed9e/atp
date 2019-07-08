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
    protected $userDisplayName = null;

    public function __construct(EntityManagerInterface $entityManager, Mapper $mapper, Activity $responseMapper)
    {
        $this->entityManager = $entityManager;
        $this->mapper = $mapper;
        $this->responseMapper = $responseMapper;

    }

    /**
     * @return int|null
     */
    public function import()
    {
        $this->getRequest()->fetch();
        $activity = new GarminActivityDetails();

        $this->mapper->setResponseMapper($this->responseMapper);

        foreach ($this->getRequest()->response() as $item) {
            $this->mapper->mapDataToObject($item, $activity);
            $this->entityManager->merge($activity);

        }

        $this->entityManager->flush();

        return null;
    }

    public function getRequest(): AbstractActivities
    {
        if (!$this->request) {
            if (null !== $this->getUserDisplayName()) {
                dump('By user display name');
                $this->request = new ByUserDisplayName();
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

    public function setActivityId($id)
    {
        $this->activityId = $id;
    }
}