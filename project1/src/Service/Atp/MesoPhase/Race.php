<?php


namespace App\Service\Atp\MesoPhase;


use App\Service\Atp\MicroPhase\MicroPhase;

class Race extends MesoPhaseAbstract
{
    protected $microPhaseIterationConfig = [1];
    protected function calculateMicroPhases()
    {
        return [
            (new MicroPhase())->setTimeValue(240),
        ];
    }
}