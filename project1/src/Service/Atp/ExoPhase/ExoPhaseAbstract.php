<?php


namespace App\Service\Atp\ExoPhase;


use App\Service\Atp\Calendar;
use App\Service\Atp\ExoPhase\PhaseToCalendar\PlaceTaker;
use App\Service\Atp\MesoPhase\Iteration\ConfigArrayAccess;
use App\Service\Atp\MesoPhase\MesoPhaseAbstract;

abstract class ExoPhaseAbstract
{
    protected $description = 'Mezocykl, cykl treningowy średniej długości, wchodzący w skład rocznego cyklu (makrocyklu) charakteryzujący dynamikę obciążeń i charakter pracy w okresie około 4 tygodni';
    protected $percentOfWeeklyAvgHours;
    protected $cyclesCount;
    protected $cycleLength;

    /** @var MesoPhaseAbstract $mesoPhase */
    protected $mesoPhase;
    /** @var ConfigArrayAccess $mesoPhaseIterationConfig */
    protected $mesoPhaseIterationConfig;
    /** @var PlaceTaker $placeTaker */
    protected $placeTaker;

    public function __construct(Calendar $calendar)
    {
        $this->setUp();
        $this->placeTaker = new PlaceTaker($calendar, $this);
    }

    abstract protected function setUp(): void;

    public function getPlaceTaker(): PlaceTaker
    {
        return $this->placeTaker;
    }

    public function getMesoPhase(): MesoPhaseAbstract
    {
        return $this->mesoPhase;
    }

    public function getMesoPhaseIterationConfig(): ConfigArrayAccess
    {
        return $this->mesoPhaseIterationConfig;
    }


    abstract public function getPercentOfWeeklyAvgHours(): float;

}