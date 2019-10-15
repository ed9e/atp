<?php


namespace App\Service\Atp\MesoPhase;


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
                (clone $this->microPhaseTmp)->setTimeValue(125)->setRatio(0.416);
            $i++;
        }
        return $return;
    }

}