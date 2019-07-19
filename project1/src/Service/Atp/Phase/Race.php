<?php


namespace App\Service\Atp\Phase;


class Race extends PhaseAbstract
{
    protected $description = 'Mezocykl startowy stanowi specyficzną dormę przygotowania się zawodnika do priorytetowych zawodów';
    protected $percentOfWeeklyAvgHours = 0.55;

    /**
     * @return float
     */
    public function getPercentOfWeeklyAvgHours(): float
    {
        return $this->percentOfWeeklyAvgHours;
    }
}