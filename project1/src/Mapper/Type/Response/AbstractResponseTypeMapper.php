<?php


namespace App\Mapper\Type\Response;


use App\Entity\AbstractEntity;
use App\Garmin\Stock\Response\Base;
use App\Mapper\Entity\MapperEntityInterface;

abstract class AbstractResponseTypeMapper implements MapperEntityInterface
{
    /**
     * @var MapReverser
     */
    protected $responseMapper;

    public function setResponseMapper(MapReverser $responseMapper)
    {
        $this->responseMapper = $responseMapper;
    }

    public function getResponseFields()
    {
        $this->responseMapper->getResponseMap();
    }

    public function mapDataToObject(Base $response, AbstractEntity $object)
    {
        $mapIterator = $this->responseMapper->getMap();

        foreach ($mapIterator as $entityFiled => $fieldMap) {
            $fieldKey = $fieldMap->getEfi()->getName();
            $value = $this->convertFunction($response->value($fieldMap->getPath()), $fieldMap->getEfi()->getConvertFunction());

            try {
                $object->__set($fieldKey, $value);
            } catch (\Exception $e) {
                if ($e instanceof UnexpectedProperty) {
                    //log new property or break if required

                }
            }

        }
    }

    protected function convertFunction($value, $function = null)
    {
        if (!$function) {
            return $value;
        }
dump($value);
        if (method_exists($this->responseMapper, $function)) {
            return $this->responseMapper->$function($value);
        }

    }

    public function mapObjectToData($object, &$data)
    {
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