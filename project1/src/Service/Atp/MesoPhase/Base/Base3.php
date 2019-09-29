<?php


namespace App\Service\Atp\MesoPhase\Base;

use App\Service\Atp\MicroPhase\MicroPhase;

class Base3 extends Base
{
    protected function calculateMicroPhases(int $count, $number = 0): array
    {
        if ($count == 4) {
            return [
                (new MicroPhase())->setTimeValue(240),
                (new MicroPhase())->setTimeValue(295),
                (new MicroPhase())->setTimeValue(325),
                (new MicroPhase())->setTimeValue(115),
            ];
        }
        return [
            (new MicroPhase())->setTimeValue(295),
            (new MicroPhase())->setTimeValue(315),
            (new MicroPhase())->setTimeValue(115),
        ];
    }
}