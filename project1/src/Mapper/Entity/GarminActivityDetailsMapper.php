<?php


namespace App\Mapper\Entity;


use App\Entity\AbstractEntity;
use App\Entity\Exception\UnexpectedProperty;
use App\Garmin\Stock\Response\ActivityDetailsResponseMapper;

class GarminActivityDetailsMapper extends AbstractActivity implements MapperEntityInterface
{
    /**
     * @var ActivityDetailsResponseMapper
     */
    protected $responseMapper;


    public function setResponseMapper(ActivityDetailsResponseMapper $responseMapper)
    {
        $this->responseMapper = $responseMapper;
    }

    public function getResponseFields()
    {
        $this->responseMapper->getResponse();
    }

    public function mapDataToObject($data, AbstractEntity $object)
    {
        $mapIterator = $this->responseMapper->getMap();

        foreach ($mapIterator as $entityFiled => $fieldMap) {
            $fieldKey = $fieldMap->getEfi()->getName();
            dump($fieldKey);
        }

    }

    public function mapObjectToData($object, &$data)
    {
    }

}