<?php


namespace App\Service\Atp\MesoPhase;


use App\Service\Atp\MicroPhase\MicroPhase;

class Preparation extends MesoPhaseAbstract
{
    protected  $description = 'Dla tego mezocyklu dlugosc cyklu wynosi 1 mikrocykl';
    protected $microPhaseIterationConfig = [1];

    protected function calculateMicroPhases(int $count): array
    {

        $return = [];
        $i = 0;
        while ($i < $count) {
            $return[] =
                (new MicroPhase())->setTimeValue(155);
            $i++;
        }
        return $return;
    }

}