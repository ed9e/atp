<?php


namespace App\Service\Atp\MesoPhase;


use App\Service\Atp\MicroPhase\MicroPhase;

class Base extends MesoPhaseAbstract
{
    /** Tu jest opcja 3 lub 4 */
    protected $microPhaseCount = [4, 3];

    protected function nextMicroPhase()
    {
        return new MicroPhase();
    }

    protected function calculateMicroPhases()
    {
        return [
            (new MicroPhase())->setTimeValue(270),
            (new MicroPhase())->setTimeValue(315),
            (new MicroPhase())->setTimeValue(345),
            (new MicroPhase())->setTimeValue(165),
        ];
    }
}