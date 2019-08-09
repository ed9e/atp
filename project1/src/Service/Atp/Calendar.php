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
    protected $groupedExoPhase;
    protected $timeValueByWeek;

    /**
     * @return mixed
     */
    public function getTimeValueByWeek()
    {
        return $this->timeValueByWeek;
    }

    /**
     * @return mixed
     */
    public function getGroupedExoPhase()
    {
        return $this->groupedExoPhase;
    }

    public function __construct($weeks)
    {
        $this->weeks = $weeks;
        $this->countWeeks = count($weeks);
    }

    /**
     * @return mixed
     */
    public function fetch(): Calendar
    {
        foreach ($this->calendar as $week => $phases) {
            $this->timeValueByWeek[$week] = $phases['microphase']->getTimeValue();
            $this->groupedExoPhase[$phases['exophase']->getLabel()][] = $week;
        }

        return $this;
        //return array_reverse($ret);
    }

    public function calculateMidOfInterval($from, $to)
    {
        $from = date_create($from)->getTimestamp();
        $to = date_create($to)->getTimestamp();
        $halfTime = $from - floor($to / 2);
        return date('Y-m-d', $halfTime);
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