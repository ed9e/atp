<?php


namespace App\Service\Atp\ExoPhase\Preparation;


use App\Service\Atp\ExoPhase\ExoPhaseAbstract;
use App\Service\Atp\MesoPhase\Iteration\Config;
use App\Service\Atp\MesoPhase\Iteration\ConfigArrayAccess;
use App\Service\Atp\PlanIterator;

class Preparation extends ExoPhaseAbstract
{
    protected $percentOfWeeklyAvgHours = 0.65;


    public function getPercentOfWeeklyAvgHours(): float
    {
        return 1.0;
    }

    protected function setUp(): void
    {
        $this->mesoPhase = \App\Service\Atp\MesoPhase\Preparation::class;
        $this->mesoPhaseIterationConfig = new ConfigArrayAccess([
            PlanIterator::FIRST_ITERATION => (new Config())->setValue(0),
            PlanIterator::SECOND_ITERATION => (new Config())->setValue(0),
            PlanIterator::THIRD_ITERATION => (new Config())->setValue(0),
            PlanIterator::FOURTH_ITERATION => (new Config())->setValue(0),
            PlanIterator::FIFTH_ITERATION => (new Config())->setMax(4),
            PlanIterator::SIXTH_ITERATION => (new Config())->setMax(2),
            PlanIterator::SEVENTH_ITERATION => (new Config())->setMax(18),
        ]);
    }
}