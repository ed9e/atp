<?php


namespace App\Service\Atp\ExoPhase\Build;


use App\Service\Atp\ExoPhase\ExoPhaseAbstract;

abstract class BuildAbstractExo extends ExoPhaseAbstract
{
    protected $description = 'Mezocykl kontrolny, praca wiąże się ściśle z uczestnictwem w szeregu testach, próbach, zawodach';
    protected $percentOfWeeklyAvgHours = [1, 0.95];

    public function getPercentOfWeeklyAvgHours(): float
    {
        return $this->percentOfWeeklyAvgHours;
    }
}