<?php


namespace App\Service\Atp\MesoPhase;


use App\Service\Atp\MicroPhase\MicroPhase;

class Peak extends MesoPhaseAbstract
{
    protected $microPhaseCount = [0, 1, 2];
    protected function calculateMicroPhases()
    {
        return [
            (new MicroPhase())->setTimeValue(255),
            (new MicroPhase())->setTimeValue(200),
        ];
    }
}