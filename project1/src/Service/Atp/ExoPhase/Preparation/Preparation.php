<?php


namespace App\Service\Atp\ExoPhase\Preparation;


use App\Service\Atp\ExoPhase\PhaseAbstract;

class Preparation extends PhaseAbstract
{
    protected $percentOfWeeklyAvgHours = 0.65;
    protected $mesoPhaseCount = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];

    public function __construct(\App\Service\Atp\MesoPhase\Preparation $mesoPhase)
    {
        $this->mesoPhase = $mesoPhase;
    }

    /**
     * @return float
     */
    public function getPercentOfWeeklyAvgHours(): float
    {
        return $this->percentOfWeeklyAvgHours;
    }
}