<?php


namespace App\Service\Atp\MesoPhase\Base;

class Base3 extends Base
{
    protected function calculateMicroPhases(int $count, $number = 0): array
    {
        if ($count === 4) {
            return [
                (clone $this->microPhaseTmp)->setTimeValue(230)->setRatio(0.766),
                (clone $this->microPhaseTmp)->setTimeValue(295)->setRatio(0.983),
                (clone $this->microPhaseTmp)->setTimeValue(305)->setRatio(1.016),
                (clone $this->microPhaseTmp)->setTimeValue(115)->setRatio(0.383),
            ];
        }
        return [
            (clone $this->microPhaseTmp)->setTimeValue(285)->setRatio(0.95),
            (clone $this->microPhaseTmp)->setTimeValue(305)->setRatio(1.016),
            (clone $this->microPhaseTmp)->setTimeValue(115)->setRatio(0.383),
        ];
    }
}