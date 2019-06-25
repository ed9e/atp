<?php


namespace App\Mapper\Entity;


use App\Entity\AbstractEntity;
use App\Garmin\Stock\Response\Base;

interface MapperEntityInterface
{
    public function mapDataToObject(Base $data, AbstractEntity $object);

    public function mapObjectToData($object, &$data);
}