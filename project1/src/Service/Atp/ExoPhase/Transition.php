<?php


namespace App\Service\Atp\ExoPhase;


use App\Service\Atp\MesoPhase\Iteration\Config;
use App\Service\Atp\MesoPhase\Iteration\ConfigArrayAccess;
use App\Service\Atp\PlanIterator;

class Transition extends ExoPhaseAbstract
{

    public function getPercentOfWeeklyAvgHours(): float
    {
        return 1.0;
    }

    protected function setUp(): void
    {
        $this->mesoPhase = new \App\Service\Atp\MesoPhase\Transition();
        $this->mesoPhaseIterationConfig = new ConfigArrayAccess([
            PlanIterator::FIRST_ITERATION => (new Config())->setValue(0),
            PlanIterator::SECOND_ITERATION => (new Config())->setValue(1),
        ]);
    }
}