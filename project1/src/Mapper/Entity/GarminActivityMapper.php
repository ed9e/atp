<?php


namespace App\Mapper\Entity;


use App\Entity\AbstractEntity;
use App\Entity\Exception\UnexpectedProperty;

class GarminActivityMapper extends AbstractActivity implements MapperEntityInterface
{
    protected $dataToObject = [
        'id' => 'garminId',

    ];
    protected $required = [
        'garmin_id', 'title', 'date'
    ];

    public function mapDataToObject($data, AbstractEntity $object)
    {
        if (null === $data) {
            return;
        }

        foreach ($data as $key => $val) {
            $objectKey = $this->dataToObjectKey($key);
            try {
                $object->__set($objectKey, $val);
            } catch (\Exception $e) {
                if ($e instanceof UnexpectedProperty) {
                    //log new property or break if required
                    if ($this->isRequired($key)) {
                        break;
                    }
                }
            }
        }
    }

    public function dataToObjectKey($dataKey)
    {
        return key_exists($dataKey, $this->dataToObject) ? $this->dataToObject[$dataKey] : $dataKey;
    }

    public function isRequired($key)
    {
        return key_exists($key, $this->required);
    }

    public function mapObjectToData($object, &$data)
    {
    }

    public function instanceOfActivity($data)
    {

    }
}