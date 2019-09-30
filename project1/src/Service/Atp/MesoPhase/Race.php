<?php


namespace App\Service\Atp\MesoPhase;


use App\Service\Atp\MicroPhase\MicroPhase;

class Race extends MesoPhaseAbstract
{
    protected $microPhaseIterationConfig = [1];

    protected function calculateMicroPhases(int $count, $number = 0): array
    {
        return [
            (new MicroPhase())->setTimeValue(140),
        ];
    }
}