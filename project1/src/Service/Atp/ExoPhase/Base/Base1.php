<?php


namespace App\Service\Atp\ExoPhase\Base;


use App\Service\Atp\MesoPhase\Base;
use App\Service\Atp\MesoPhase\Iteration\Config;
use App\Service\Atp\MesoPhase\Iteration\ConfigArrayAccess;
use App\Service\Atp\PlanIterator;

class Base1 extends BaseAbstractExo
{
    protected function setUp(): void
    {
        $this->mesoPhase = Base\Base1::class;
        $this->mesoPhaseIterationConfig = new ConfigArrayAccess([
            PlanIterator::FIRST_ITERATION => (new Config())->setValue(0),
            PlanIterator::SECOND_ITERATION => (new Config())->setValue(0),
            PlanIterator::THIRD_ITERATION => (new Config())->setValue(0),
            PlanIterator::FOURTH_ITERATION => (new Config())->setValue(1),
            PlanIterator::FIFTH_ITERATION => (new Config())->setValue(0),
            PlanIterator::SIXTH_ITERATION => (new Config())->setValue(1),
            PlanIterator::SEVENTH_ITERATION => (new Config())->setValue(1),
        ]);
    }
}