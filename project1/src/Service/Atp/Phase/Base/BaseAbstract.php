<?php


namespace App\Service\Atp\Phase\Base;


use App\Service\Atp\Phase\PhaseAbstract;

class BaseAbstract extends PhaseAbstract
{
    protected $percentOfWeeklyAvgHours = [0.55, 0.85, 1, 1.15];

    public function getPercentOfWeeklyAvgHours(): float
    {
        return $this->percentOfWeeklyAvgHours;
    }
}