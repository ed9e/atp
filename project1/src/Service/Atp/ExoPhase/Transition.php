<?php


namespace App\Service\Atp\ExoPhase;


class Transition extends PhaseAbstract
{
    public function getPercentOfWeeklyAvgHours(): float
    {
        return 1.0;
    }
}