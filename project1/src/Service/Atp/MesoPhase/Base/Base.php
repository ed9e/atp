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
        if ($count === 4) {
            return [
                (clone $this->microPhaseTmp)->setTimeValue(220)->setRatio(0.733),
                (clone $this->microPhaseTmp)->setTimeValue(265)->setRatio(0.883),
                (clone $this->microPhaseTmp)->setTimeValue(295)->setRatio(0.983),
                (clone $this->microPhaseTmp)->setTimeValue(115)->setRatio(0.383),
            ];
        }
        return [
            (clone $this->microPhaseTmp)->setTimeValue(275)->setRatio(0.916),
            (clone $this->microPhaseTmp)->setTimeValue(305)->setRatio(1.016),
            (clone $this->microPhaseTmp)->setTimeValue(115)->setRatio(0.383),
        ];
    }
}