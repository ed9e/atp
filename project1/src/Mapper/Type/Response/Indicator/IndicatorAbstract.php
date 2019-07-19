<?php


namespace App\Mapper\Type\Response\Indicator;


use App\Mapper\Type\Response\MapInterface;

abstract class IndicatorAbstract
{
    abstract public function createMap($path): MapInterface;
}