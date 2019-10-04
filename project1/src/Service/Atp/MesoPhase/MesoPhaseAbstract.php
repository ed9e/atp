<?php


namespace App\Service\Atp\MesoPhase;


use App\Service\Atp\Calendar;
use App\Service\Atp\MicroPhase\MicroPhase;

abstract class MesoPhaseAbstract
{
    /** @var Calendar */
    protected $calendar;
    /** @var \App\Service\Atp\MicroPhase\PhaseIterator */
    protected $microPhases;
    protected $microPhaseTmp;
    /**
     * Ilość mikrocykli w tym cyklu
     * @var array $microPhaseIterationConfig
     */
    protected $microPhaseIterationConfig;
    protected $number;

    public function __construct($calendar)
    {
        $this->calendar = $calendar;
        $this->microPhases = new \App\Service\Atp\MicroPhase\PhaseIterator();
        $this->microPhaseTmp = new MicroPhase($this->calendar->getRequestStack());
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function setNumber($number): MesoPhaseAbstract
    {
        $this->number = $number;
        return $this;
    }

    public function getMicroPhases(): \App\Service\Atp\MicroPhase\PhaseIterator
    {
        return $this->microPhases;
    }

    public function setUpMicroPhases($microPhasesCount): MesoPhaseAbstract
    {
        $this->microPhases->push($this->calculateMicroPhases($microPhasesCount));
        return $this;
    }

    abstract protected function calculateMicroPhases(int $microPhasesCount): array;

    public function setCalendar(Calendar $calendar): MesoPhaseAbstract
    {
        $this->calendar = $calendar;
        return $this;
    }

    public function iterationMicroPhasesCount(): int
    {
        /** pierwszą wartość, TODO: opcjonalna ilość */
        if ($this->shouldCutPhase()) {
            return end($this->microPhaseIterationConfig);
        }
        return reset($this->microPhaseIterationConfig);

    }

    protected function shouldCutPhase(): bool
    {
        return $this->calendar->getCountWeeks() < 13;
    }
}