<?php


namespace App\Service\Atp\ExoPhase;


use App\Service\Atp\MesoPhase\Iteration\Config;
use App\Service\Atp\MesoPhase\Iteration\ConfigArrayAccess;
use App\Service\Atp\PlanIterator;

class Race extends ExoPhaseAbstract
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

    protected function setUp(): void
    {
        $this->mesoPhase = new \App\Service\Atp\MesoPhase\Race();
        $this->mesoPhaseIterationConfig = new ConfigArrayAccess([
            PlanIterator::FIRST_ITERATION => (new Config())->setValue(1),
        ]);
    }


}