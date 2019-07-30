<?php


namespace App\Service\Atp\MesoPhase;


use App\Service\Atp\Calendar;

abstract class MesoPhaseAbstract
{
    /** @var Calendar */
    protected $calendar;
    /** @var \App\Service\Atp\MicroPhase\PhaseIterator */
    protected $microPhases;
    /**
     * Ilość mikrocykli w tym cyklu
     * @var array $microPhaseIterationConfig
     */
    protected $microPhaseIterationConfig;
    protected $number;

    public function __construct()
    {
        $this->microPhases = new \App\Service\Atp\MicroPhase\PhaseIterator();
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

    abstract protected function calculateMicroPhases(int $microPhasesCount, $number = 0): array;

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