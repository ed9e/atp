<?php


namespace App\Service\Atp\MesoPhase;


use App\Service\Atp\MicroPhase\MicroPhase;

class Peak extends MesoPhaseAbstract
{
    protected $microPhaseIterationConfig = [1];

    protected function calculateMicroPhases(int $count): array
    {
        $phases = array_reverse([
            (new MicroPhase())->setTimeValue(255),
            (new MicroPhase())->setTimeValue(200),
        ]);

        return [$phases[$this->getNumber()]];
    }
}