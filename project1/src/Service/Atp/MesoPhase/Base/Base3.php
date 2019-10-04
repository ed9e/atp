<?php


namespace App\Service\Atp\MesoPhase\Base;

class Base3 extends Base
{
    protected function calculateMicroPhases(int $count, $number = 0): array
    {
        if ($count == 4) {
            return [
                (clone $this->microPhaseTmp)->setTimeValue(230),
                (clone $this->microPhaseTmp)->setTimeValue(295),
                (clone $this->microPhaseTmp)->setTimeValue(305),
                (clone $this->microPhaseTmp)->setTimeValue(115),
            ];
        }
        return [
            (clone $this->microPhaseTmp)->setTimeValue(285),
            (clone $this->microPhaseTmp)->setTimeValue(305),
            (clone $this->microPhaseTmp)->setTimeValue(115),
        ];
    }
}