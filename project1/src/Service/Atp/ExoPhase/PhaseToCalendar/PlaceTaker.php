<?php


namespace App\Service\Atp\ExoPhase\PhaseToCalendar;


use App\Service\Atp\Calendar;
use App\Service\Atp\ExoPhase\ExoPhaseAbstract;

class PlaceTaker
{
    protected $calendar;
    /** @var ExoPhaseAbstract */
    protected $phase;
    protected $iterationNo;
    protected $taken;

    public function __construct(Calendar $calendar, ExoPhaseAbstract $phase)
    {
        $this->calendar = $calendar;
        $this->phase = $phase;

    }

    public function getTaken()
    {
        return $this->taken;
    }

    public function takePlace($iterationNo): void
    {
        $this->iterationNo = $iterationNo;

        $toTake = $this->iterationMicroPhasesCount();
        if ($toTake > 0) {
            if (!$this->calendar->valid($toTake)) {
                throw new \Exception();
            }
            $this->phase->lastMesoPhase()->setMicroPhases($toTake);
        } else {
            //$this->phase->getMesoPhases()->pop();
        }
        $this->calendar->sub($toTake);
        $this->taken += $toTake;
//        if($toTake>0) {
//            dump(get_class($this->phase) . ' ' . $toTake);
//        }else{
//            dump("");
//        }
    }

    protected function iterationMicroPhasesCount(): int
    {
        $mesoPhaseCount = $this->iterationMesoPhaseCount();
        $microPhasesCount = 0;

        for ($i = $mesoPhaseCount; $i > 0; $i--) {

            $this->phase->createMesoPhase();
            $microPhasesCount += $this->phase->lastMesoPhase()->iterationMicroPhasesCount();
        }
        return $microPhasesCount;
    }

    protected function iterationMesoPhaseCount()
    {
        if (!$this->phase->getMesoPhaseIterationConfig()->offsetExists($this->iterationNo)) {
            return 0;
        }
        $config = $this->phase->getMesoPhaseIterationConfig()[$this->iterationNo];
        if ($config->getValue() !== null) {
            return $config->getValue();
        }
        if ($config->getMax() !== null) {
            return min([$this->calendar->getCountWeeks(), $config->getMax()]);

        }

    }
}