<?php


namespace App\Service\Atp;


use App\Service\Atp\ExoPhase\PhaseIterator;
use App\Service\Atp\MicroPhase\PhaseIterator as MicroPhaseIterator;

class Calendar
{
    protected $weeks;
    protected $countWeeks;
    protected $weekPointer = 0;
    protected $calendar;

    public function __construct($weeks)
    {
        $this->weeks = $weeks;
        $this->countWeeks = count($weeks);
    }

    /**
     * @return mixed
     */
    public function getCalendar()
    {
        foreach ($this->calendar as $week => $phases) {
            $ret[$week] = get_class($phases['mesophase']) . ': ' . $phases['microphase']->getTimeValue();
        }
        return $ret;
    }

    public function fill(PhaseIterator $phaseIterator)
    {
        foreach ($phaseIterator as $exoPhase) {
            foreach ($exoPhase->getMesoPhases() as $mesoPhase) {
                $this->setExoPhase($mesoPhase->getMicroPhases(), $mesoPhase, $exoPhase);
            }
        }
    }

    public function setExoPhase(MicroPhaseIterator $microPhases, $mesoPhase, $exoPhase): void
    {
        $count = count($microPhases);

        while ($count > 0) {
            $count--;

            $this->calendar[$this->weeks[$this->weekPointer]] = [
                'exophase' => $exoPhase,
                'mesophase' => $mesoPhase,
                'microphase' => $microPhases->first(),
            ];
            $this->weekPointer++;
        }
    }

    /**
     * @return int
     */
    public function getCountWeeks(): int
    {
        return $this->countWeeks;
    }

    public function valid($sub)
    {
        return $this->countWeeks >= $sub;
    }

    public function sub(int $sub): void
    {
        $this->countWeeks -= $sub;
    }

}