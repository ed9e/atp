<?php


namespace App\Service\Atp\MesoPhase;


use App\Service\Atp\Calendar;

abstract class MesoPhaseAbstract
{
    /** @var Calendar */
    protected $calendar;
    protected $microPhases = [];
    /**
     * Ilość mikrocykli w tym cyklu
     * @var array $microPhaseIterationConfig
     */
    protected $microPhaseIterationConfig;

    /**
     * @return mixed
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param mixed $number
     * @return MesoPhaseAbstract
     */
    public function setNumber($number)
    {
        $this->number = $number;
        return $this;
    }

    protected $number;

    public function getMicroPhases(): array
    {
        return $this->microPhases;
    }

    public function setMicroPhases($week): MesoPhaseAbstract
    {
        $this->microPhases[] = $week;
        return $this;
    }

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