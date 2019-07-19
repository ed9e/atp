<?php


namespace App\Service\Atp\Phase\Preparation;


use App\Service\Atp\Phase\PhaseAbstract;

class Preparation extends PhaseAbstract
{
    protected $percentOfWeeklyAvgHours = 0.65;

    /**
     * @return float
     */
    public function getPercentOfWeeklyAvgHours(): float
    {
        return $this->percentOfWeeklyAvgHours;
    }
}