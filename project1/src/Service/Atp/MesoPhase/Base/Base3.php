<?php


namespace App\Service\Atp\MesoPhase\Base;

use App\Service\Atp\MicroPhase\MicroPhase;

class Base3 extends Base
{
    protected function calculateMicroPhases(int $count, $number = 0): array
    {
        if ($count == 4) {
            return [
                (new MicroPhase())->setTimeValue(230),
                (new MicroPhase())->setTimeValue(295),
                (new MicroPhase())->setTimeValue(305),
                (new MicroPhase())->setTimeValue(115),
            ];
        }
        return [
            (new MicroPhase())->setTimeValue(285),
            (new MicroPhase())->setTimeValue(305),
            (new MicroPhase())->setTimeValue(115),
        ];
    }
}