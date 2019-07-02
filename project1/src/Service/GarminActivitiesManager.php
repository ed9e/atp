<?php


namespace App\Service;


use App\Entity\GarminActivity;
use App\Garmin\Stock\Request\Activities as ActivitiesRequest;
use App\Garmin\Stock\ResponseMap\Activity;
use App\Mapper\Entity\GarminActivityDetailsEntityMapper as Mapper;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;

class GarminActivitiesManager
{
    protected $entityManager;
    protected $mapper;
    protected $responseMapper;
    protected $logger;
    protected $activityId;

    public function __construct(EntityManagerInterface $entityManager, Mapper $mapper, Activity $responseMapper, LoggerInterface $logger)
    {
        $this->entityManager = $entityManager;
        $this->mapper = $mapper;
        $this->responseMapper = $responseMapper;
        $this->logger = $logger;
    }

    /**
     * @return int|null
     */
    public function import()
    {
        $request = new ActivitiesRequest();

        $request->fetch();
        $activity = new GarminActivity();

        $this->mapper->setResponseMapper($this->responseMapper);

        foreach ($request->response() as $item) {
            $this->mapper->mapDataToObject($item, $activity);
            dump($activity->getTitle());
            //$this->entityManager->merge($activity);
        }

        //$this->entityManager->flush();

        return null;
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