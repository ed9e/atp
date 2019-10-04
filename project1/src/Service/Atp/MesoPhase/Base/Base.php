<?php


namespace App\Service\Atp\MesoPhase\Base;


use App\Service\Atp\MesoPhase\MesoPhaseAbstract;
use App\Service\Atp\MicroPhase\MicroPhase;

class Base extends MesoPhaseAbstract
{
    /** Tu jest opcja 3 lub 4 */
    protected $microPhaseIterationConfig = [4, 3];

    protected function nextMicroPhase()
    {
        return new MicroPhase();
    }

    protected function calculateMicroPhases(int $count, $number = 0): array
    {
        if ($count == 4) {
            return [
                (clone $this->microPhaseTmp)->setTimeValue(220),
                (clone $this->microPhaseTmp)->setTimeValue(265),
                (clone $this->microPhaseTmp)->setTimeValue(295),
                (clone $this->microPhaseTmp)->setTimeValue(115),
            ];
        }
        return [
            (clone $this->microPhaseTmp)->setTimeValue(275),
            (clone $this->microPhaseTmp)->setTimeValue(305),
            (clone $this->microPhaseTmp)->setTimeValue(115),
        ];
    }
}