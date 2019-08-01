<?php


namespace App\Service\Atp\MesoPhase\Base;

use App\Service\Atp\MicroPhase\MicroPhase;

class Base3 extends Base
{
    protected function calculateMicroPhases(int $count, $number = 0): array
    {
        if ($count == 4) {
            return [
                (new MicroPhase())->setTimeValue(290),
                (new MicroPhase())->setTimeValue(335),
                (new MicroPhase())->setTimeValue(365),
                (new MicroPhase())->setTimeValue(165),
            ];
        }
        return [
            (new MicroPhase())->setTimeValue(335),
            (new MicroPhase())->setTimeValue(365),
            (new MicroPhase())->setTimeValue(165),
        ];
    }
}