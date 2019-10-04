<?php


namespace App\Service\Atp\MesoPhase\Base;

class Base2 extends Base
{
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