<?php


namespace App\Service;


use App\Entity\GarminActivityDetails;
use App\Garmin\Stock\Request\ActivityDetails as ActivityDetailsRequest;
use App\Garmin\Stock\ResponseMap\ActivityDetails;
use App\Mapper\Entity\GarminActivityDetailsEntityMapper as Mapper;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;

class GarminActivityDetailsManager
{
    protected $entityManager;
    protected $mapper;
    protected $responseMapper;
    protected $logger;
    protected $activityId;

    public function __construct(EntityManagerInterface $entityManager, Mapper $mapper, ActivityDetails $responseMapper, LoggerInterface $logger)
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
        $request = new ActivityDetailsRequest();
        $request->setActivityId($this->activityId);
        $request->fetch();
        $activity = new GarminActivityDetails();

        $this->mapper->setResponseMapper($this->responseMapper);
        $this->mapper->mapDataToObject($request->response(), $activity);

        $this->entityManager->merge($activity);


        $this->entityManager->flush();

        return null;
    }

    public function setActivityId($id)
    {
        $this->activityId = $id;
    }
}