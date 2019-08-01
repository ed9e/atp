<?php


namespace App\Service\Atp\MesoPhase\Base;

use App\Service\Atp\MicroPhase\MicroPhase;

class Base2 extends Base
{
    protected function calculateMicroPhases(int $count, $number = 0): array
    {
        if ($count == 4) {
            return [
                (new MicroPhase())->setTimeValue(280),
                (new MicroPhase())->setTimeValue(325),
                (new MicroPhase())->setTimeValue(355),
                (new MicroPhase())->setTimeValue(165),
            ];
        }
        return [
            (new MicroPhase())->setTimeValue(325),
            (new MicroPhase())->setTimeValue(355),
            (new MicroPhase())->setTimeValue(165),
        ];
    }
}