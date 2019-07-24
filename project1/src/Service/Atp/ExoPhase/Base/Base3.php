<?php


namespace App\Service\Atp\ExoPhase\Base;


use App\Service\Atp\MesoPhase\Base;
use App\Service\Atp\MesoPhase\Iteration\Config;
use App\Service\Atp\MesoPhase\Iteration\ConfigArrayAccess;
use App\Service\Atp\PlanIterator;

class Base3 extends BaseAbstractExo
{

    protected function setUp(): void
    {
        $this->mesoPhase = new Base();
        $this->mesoPhaseIterationConfig = new ConfigArrayAccess([
            PlanIterator::FIRST_ITERATION => (new Config())->setValue(0),
            PlanIterator::SECOND_ITERATION => (new Config())->setValue(1),
            PlanIterator::THIRD_ITERATION => (new Config())->setValue(1)
        ]);
    }
}