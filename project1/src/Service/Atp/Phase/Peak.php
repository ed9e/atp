<?php


namespace App\Service\Atp\Phase;


class Peak extends PhaseAbstract
{
    public function getPercentOfWeeklyAvgHours(): float
    {
        return 1.0;
    }
}