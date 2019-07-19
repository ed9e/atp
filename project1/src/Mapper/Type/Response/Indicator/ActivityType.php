<?php


namespace App\Mapper\Type\Response\Indicator;


use App\Mapper\Type\Response\ActivityTypeMap;
use App\Mapper\Type\Response\EntityFieldIndicator;
use App\Mapper\Type\Response\MapInterface;
use App\Mapper\Type\Response\ValuePath;

class ActivityType extends EntityFieldIndicator
{
    protected $entity;

    /**
     * @return mixed
     */
    public function getEntity()
    {
        return $this->entity;
    }

    public function createMap($path): MapInterface
    {
        return new ActivityTypeMap($this, new ValuePath($path));
    }
}