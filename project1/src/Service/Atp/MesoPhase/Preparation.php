<?php


namespace App\Service\Atp\MesoPhase;


use App\Service\Atp\MicroPhase\MicroPhase;

class Preparation extends MesoPhaseAbstract
{
    protected  $description = 'Dla tego mezocyklu dlugosc cyklu wynosi 1 mikrocykl';
    protected $microPhaseIterationConfig = [1];

    protected function calculateMicroPhases(int $count, $number = 0): array
    {
        return [
            (new MicroPhase())->setTimeValue(155),
        ];
    }

}