<?php


namespace App\Mapper\Entity;


use App\Entity\AbstractEntity;
use App\Garmin\Stock\Response\ActivityDetailsResponseMapper;
use App\Mapper\Response\Mapper;
use App\Mapper\Response\ValuePath;

abstract class AbstractResponseMapper implements MapperEntityInterface
{
    /**
     * @var ActivityDetailsResponseMapper
     */
    protected $responseMapper;

    public function setResponseMapper(Mapper $responseMapper)
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
//dump($mapIterator);
        foreach ($mapIterator as $entityFiled => $fieldMap) {
            $fieldKey = $fieldMap->getEfi()->getName();

            $val = $this->fetchValue($data, $fieldMap->getPath());
            dump([$fieldKey => $val]);
//            try {
//                $object->__set($fieldKey, $val);
//            } catch (\Exception $e) {
//                if ($e instanceof UnexpectedProperty) {
//                    //log new property or break if required
//
//                }
//            }
//            dump($fieldKey);
        }
    }


    protected function fetchValue($data, ValuePath $path)
    {
        $_data = $data;
        foreach ($path->getArray() as $pathKey) {
            $_data = $_data[$pathKey];
        }
        return $_data;
    }
}