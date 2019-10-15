<?php


namespace App\Service\Atp\MesoPhase;


class Peak extends MesoPhaseAbstract
{
    protected $microPhaseIterationConfig = [1];

    protected function calculateMicroPhases(int $count): array
    {
        $phases = array_reverse([
            (clone $this->microPhaseTmp)->setTimeValue(255)->setRatio(0.85),
            (clone $this->microPhaseTmp)->setTimeValue(200)->setRatio(0.666),
        ]);

        return [$phases[$this->getNumber()]];
    }
}