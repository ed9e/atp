<?php


namespace App\Mapper\Entity;


use App\Mapper\Type\Response\AbstractResponseTypeMapper;

class GarminActivityDetailsEntityMapper extends AbstractResponseTypeMapper
{
     protected $entity = 'GarminActivity';


    public function mapObjectToData($object, &$data): void
    {
    }

}