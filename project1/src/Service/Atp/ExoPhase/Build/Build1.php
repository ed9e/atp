<?php


namespace App\Service\Atp\ExoPhase\Build;


use App\Service\Atp\ExoPhase\ExoPhaseAbstract;
use App\Service\Atp\MesoPhase\Build;
use App\Service\Atp\MesoPhase\Iteration\Config;
use App\Service\Atp\MesoPhase\Iteration\ConfigArrayAccess;
use App\Service\Atp\PlanIterator;

class Build1 extends ExoPhaseAbstract
{

    public function getPercentOfWeeklyAvgHours(): float
    {
        return 1.0;
    }

    protected function setUp(): void
    {
        $this->mesoPhase = new Build();
        $this->mesoPhaseIterationConfig = new ConfigArrayAccess([
            PlanIterator::FIRST_ITERATION => (new Config())->setValue(1),
            PlanIterator::SECOND_ITERATION => (new Config())->setValue(1)
        ]);
    }
}