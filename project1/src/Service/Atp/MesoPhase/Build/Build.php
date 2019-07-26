<?php


namespace App\Service\Atp\MesoPhase\Build;


use App\Service\Atp\MesoPhase\MesoPhaseAbstract;
use App\Service\Atp\MicroPhase\MicroPhase;

class Build extends MesoPhaseAbstract
{
    /** Tu jest opcja 3 lub 4 */
    protected $microPhaseIterationConfig = [4, 3];

    protected function calculateMicroPhases()
    {
        return [
            (new MicroPhase())->setTimeValue(315),
            (new MicroPhase())->setTimeValue(315),
            (new MicroPhase())->setTimeValue(315),
            (new MicroPhase())->setTimeValue(155),
        ];
    }
}