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
                (new MicroPhase())->setTimeValue(270),
                (new MicroPhase())->setTimeValue(315),
                (new MicroPhase())->setTimeValue(345),
                (new MicroPhase())->setTimeValue(165),
            ];
        }
        return [
            (new MicroPhase())->setTimeValue(315),
            (new MicroPhase())->setTimeValue(345),
            (new MicroPhase())->setTimeValue(165),
        ];
    }
}