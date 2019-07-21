<?php


namespace App\Service\Atp\ExoPhase;


class Peak extends PhaseAbstract
{
    public function getPercentOfWeeklyAvgHours(): float
    {
        return 1.0;
    }
}