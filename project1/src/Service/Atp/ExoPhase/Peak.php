<?php


namespace App\Service\Atp\ExoPhase;


use App\Service\Atp\MesoPhase\Iteration\Config;
use App\Service\Atp\MesoPhase\Iteration\ConfigArrayAccess;
use App\Service\Atp\PlanIterator;

class Peak extends ExoPhaseAbstract
{
    protected $mesoPhaseIterationConfig = [PlanIterator::FIRST_ITERATION => 1, PlanIterator::SECOND_ITERATION => 1];

    public function getPercentOfWeeklyAvgHours(): float
    {
        return 1.0;
    }

    protected function setUp(): void
    {
        $this->mesoPhase = new \App\Service\Atp\MesoPhase\Peak();
        $this->mesoPhaseIterationConfig = new ConfigArrayAccess([
            PlanIterator::FIRST_ITERATION => (new Config())->setValue(1),
            PlanIterator::SECOND_ITERATION => (new Config())->setValue(1)
        ]);
    }
}