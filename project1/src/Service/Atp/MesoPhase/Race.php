<?php


namespace App\Service\Atp\MesoPhase;


class Race extends MesoPhaseAbstract
{
    protected $microPhaseIterationConfig = [1];

    protected function calculateMicroPhases(int $count, $number = 0): array
    {
        return [
            (clone $this->microPhaseTmp)->setTimeValue(140)->setRatio(0.466),
        ];
    }
}