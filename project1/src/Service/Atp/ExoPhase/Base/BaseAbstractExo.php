<?php


namespace App\Service\Atp\ExoPhase\Base;


use App\Service\Atp\ExoPhase\ExoPhaseAbstract;

abstract class BaseAbstractExo extends ExoPhaseAbstract
{
    protected $percentOfWeeklyAvgHours = [0.55, 0.85, 1, 1.15];

    public function getPercentOfWeeklyAvgHours(): float
    {
        return $this->percentOfWeeklyAvgHours;
    }

}