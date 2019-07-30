<?php


namespace App\Service\Atp\MesoPhase\Build;


use App\Service\Atp\MesoPhase\MesoPhaseAbstract;
use App\Service\Atp\MicroPhase\MicroPhase;

class Build extends MesoPhaseAbstract
{
    /** Tu jest opcja 3 lub 4 */
    protected $microPhaseIterationConfig = [4, 3];

    protected function calculateMicroPhases(int $count, $number = 0): array
    {
        if ($count == 4) {
            return [
                (new MicroPhase())->setTimeValue(315),
                (new MicroPhase())->setTimeValue(315),
                (new MicroPhase())->setTimeValue(315),
                (new MicroPhase())->setTimeValue(155),
            ];
        }
        return [
            (new MicroPhase())->setTimeValue(315),
            (new MicroPhase())->setTimeValue(315),
            (new MicroPhase())->setTimeValue(155),
        ];
    }
}