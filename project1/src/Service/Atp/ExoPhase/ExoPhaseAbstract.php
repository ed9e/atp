<?php


namespace App\Service\Atp\ExoPhase;


use App\Service\Atp\Calendar;
use App\Service\Atp\ExoPhase\PhaseToCalendar\PlaceTaker;
use App\Service\Atp\MesoPhase\Iteration\ConfigArrayAccess;
use App\Service\Atp\MesoPhase\MesoPhaseAbstract;
use ReflectionClass;

abstract class ExoPhaseAbstract
{
    protected $description = 'Mezocykl, cykl treningowy średniej długości, wchodzący w skład rocznego cyklu (makrocyklu) charakteryzujący dynamikę obciążeń i charakter pracy w okresie około 4 tygodni';
    protected $percentOfWeeklyAvgHours;
    protected $cyclesCount;
    protected $cycleLength;
    protected $label;

    public function getLabel(): string
    {
        return (new ReflectionClass($this))->getShortName();
        //return $this->label;
    }

    /** @var string class name of mesoPhase */
    protected $mesoPhase;
    /** @var \App\Service\Atp\MesoPhase\PhaseIterator */
    protected $mesoPhases;

    /** @var ConfigArrayAccess $mesoPhaseIterationConfig */
    protected $mesoPhaseIterationConfig;
    /** @var PlaceTaker $placeTaker */
    protected $placeTaker;

    /** @var Calendar */
    protected $calendar;
    protected $i = 0;

    public function __construct(Calendar $calendar)
    {
        $this->setUp();
        $this->calendar = $calendar;
        $this->placeTaker = new PlaceTaker($calendar, $this);
        $this->mesoPhases = new \App\Service\Atp\MesoPhase\PhaseIterator();
    }

    abstract protected function setUp(): void;

    public function createMesoPhase(): MesoPhaseAbstract
    {
        $this->mesoPhases[] = new $this->mesoPhase($this->calendar);
        $this->lastMesoPhase()->setCalendar($this->calendar)->setNumber($this->i);
        $this->i++;
        return $this->lastMesoPhase();
    }

    public function lastMesoPhase(): MesoPhaseAbstract
    {
        return $this->mesoPhases->end();
    }

    public function getPlaceTaker(): PlaceTaker
    {
        return $this->placeTaker;
    }

    public function getMesoPhaseIterationConfig(): ConfigArrayAccess
    {
        return $this->mesoPhaseIterationConfig;
    }

    abstract public function getPercentOfWeeklyAvgHours(): float;

    public function getMesoPhases(): \App\Service\Atp\MesoPhase\PhaseIterator
    {
        return $this->mesoPhases;
    }


}