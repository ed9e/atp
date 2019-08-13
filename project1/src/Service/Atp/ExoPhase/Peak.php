<?php


namespace App\Service\Atp\ExoPhase;


use App\Service\Atp\MesoPhase\Iteration\Config;
use App\Service\Atp\MesoPhase\Iteration\ConfigArrayAccess;
use App\Service\Atp\PlanIterator;

class Peak extends ExoPhaseAbstract
{
    public function getPercentOfWeeklyAvgHours(): float
    {
        return 1.0;
    }

    protected function setUp(): void
    {
        $this->mesoPhase = \App\Service\Atp\MesoPhase\Peak::class;

        $this->mesoPhaseIterationConfig = new ConfigArrayAccess([
            PlanIterator::FIRST_ITERATION => (new Config())->setValue(0),
            PlanIterator::SECOND_ITERATION => (new Config())->setValue(0),
            PlanIterator::THIRD_ITERATION => (new Config())->setValue(0),
            PlanIterator::FOURTH_ITERATION => (new Config())->setValue(0),
            PlanIterator::FIFTH_ITERATION => (new Config())->setValue(1),
            PlanIterator::SIXTH_ITERATION => (new Config())->setValue(0),
            PlanIterator::SEVENTH_ITERATION => (new Config())->setValue(1),
        ]);
    }

}