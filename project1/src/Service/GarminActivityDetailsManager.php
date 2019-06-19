<?php


namespace App\Service;


use App\Entity\GarminActivity;
use App\Garmin\Stock\Request\ActivityDetails as ActivityDetailsRequest;
use App\Garmin\Stock\ResponseMap\ActivityDetails;
use App\Mapper\Entity\GarminResponseMapperDetailsMapper as Mapper;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;

class GarminActivityDetailsManager
{
    protected $entityManager;
    protected $mapper;
    protected $responseMapper;
    protected $logger;

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
        $item = [];
        $garmin = new ActivityDetailsRequest();
        $garmin->fetch();

        $item = $garmin->get();

        $activity = new GarminActivity();
        $this->mapper->setResponseMapper($this->responseMapper);
        $this->mapper->mapDataToObject($item, $activity);
        //$this->entityManager->merge($activity);


        //$this->entityManager->flush();

        return null;
    }
}