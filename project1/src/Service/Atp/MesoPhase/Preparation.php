<?php


namespace App\Service\Atp\MesoPhase;


use App\Service\Atp\MicroPhase\MicroPhase;

class Preparation extends MesoPhaseAbstract
{
    protected  $description = 'Dla tego mezocyklu dlugosc cyklu wynosi 1 mikrocykl';
    protected $microPhaseIterationConfig = [1];

    protected function calculateMicroPhases()
    {
        return [
            (new MicroPhase())->setTimeValue(155),
        ];
    }

}