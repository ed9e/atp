<?php


namespace App\Mapper\Entity;


use App\Entity\AbstractEntity;

interface MapperEntityInterface
{
    public function mapDataToObject($data, AbstractEntity $object);

    public function mapObjectToData($object, &$data);
}