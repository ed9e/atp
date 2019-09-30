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
                (new MicroPhase())->setTimeValue(220),
                (new MicroPhase())->setTimeValue(265),
                (new MicroPhase())->setTimeValue(295),
                (new MicroPhase())->setTimeValue(115),
            ];
        }
        return [
            (new MicroPhase())->setTimeValue(275),
            (new MicroPhase())->setTimeValue(305),
            (new MicroPhase())->setTimeValue(115),
        ];
    }
}