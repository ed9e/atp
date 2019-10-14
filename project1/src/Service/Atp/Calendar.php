<?php


namespace App\Service\Atp;


use App\Service\Atp\ExoPhase\PhaseIterator;
use App\Service\Atp\ExoPhase\Race;
use App\Service\Atp\MicroPhase\PhaseIterator as MicroPhaseIterator;

class Calendar
{
    protected $weeks = [];
    protected $countWeeks;
    protected $weekPointer = 0;
    protected $calendar;
    protected $groupedExoPhase;
    protected $timeValueByWeek;
    protected $requestStack;
    protected $planNo = 0;

    /**
     * @return mixed
     */
    public function getRequestStack()
    {
        return $this->requestStack;
    }

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

    public function __construct($requestStack)
    {

        $this->requestStack = $requestStack;
    }

    public function addWeeks($weeks): Calendar
    {
        $this->weeks = array_merge($weeks, $this->weeks);
        $this->countWeeks = count($weeks);
        $this->weekPointer = 0;
        return $this;
    }

    /**
     * @return mixed
     */
    public function fetch(): Calendar
    {
        foreach ($this->calendar as $week => $phases) {
            $this->timeValueByWeek[$week] = $phases['microphase']->getTimeValue();
            $this->groupedExoPhase[$this->planNo][$phases['exophase']->getLabel()][] = $week;
            if (get_class($phases['exophase']) === Race::class) {
                $this->planNo++;
            }
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

    public function fill(PhaseIterator $phaseIterator): void
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

            if (array_key_exists($this->weekPointer, $this->weeks)) {
                $this->calendar[$this->weeks[$this->weekPointer]] = [
                    'exophase' => $exoPhase,
                    'mesophase' => $mesoPhase,
                    'microphase' => $microPhases->first(),
                ];
                $this->weekPointer++;
            }
        }
        ksort($this->calendar);
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