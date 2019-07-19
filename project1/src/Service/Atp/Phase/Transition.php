<?php


namespace App\Service\Atp\Phase;


class Transition extends PhaseAbstract
{
    public function getPercentOfWeeklyAvgHours(): float
    {
        return 1.0;
    }
}