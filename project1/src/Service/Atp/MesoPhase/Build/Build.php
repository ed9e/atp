<?php


namespace App\Service\Atp\MesoPhase\Build;


use App\Service\Atp\MesoPhase\MesoPhaseAbstract;

class Build extends MesoPhaseAbstract
{
    /** Tu jest opcja 3 lub 4 */
    protected $microPhaseIterationConfig = [4, 3];

    protected function calculateMicroPhases(int $count): array
    {
        if ($count == 4) {
            return [
                (clone $this->microPhaseTmp)->setTimeValue(285),
                (clone $this->microPhaseTmp)->setTimeValue(285),
                (clone $this->microPhaseTmp)->setTimeValue(285),
                (clone $this->microPhaseTmp)->setTimeValue(125),
            ];
        }
        return [
            (clone $this->microPhaseTmp)->setTimeValue(285),
            (clone $this->microPhaseTmp)->setTimeValue(295),
            (clone $this->microPhaseTmp)->setTimeValue(125),
        ];
    }
}