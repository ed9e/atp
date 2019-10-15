<?php


namespace App\Service\Atp;


use App\Service\Atp\ExoPhase\ExoPhaseAbstract;
use App\Service\Atp\ExoPhase\PhaseIterator;
use App\Service\Atp\ExoPhase\Race;
use App\Service\Atp\MicroPhase\MicroPhase;
use App\Service\Atp\MicroPhase\PhaseIterator as MicroPhaseIterator;
use Symfony\Component\HttpFoundation\RequestStack;

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
     * @return RequestStack
     */
    public function getRequestStack(): RequestStack
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

    public function __construct(RequestStack $requestStack)
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
            /** @var MicroPhase $microPhase */
            $microPhase = $phases['microphase'];
            $this->timeValueByWeek[$week] = $microPhase->getTimeValue();
            /** @var ExoPhaseAbstract $exoPhase */
            $exoPhase = $phases['exophase'];
            $this->groupedExoPhase[$this->planNo][$exoPhase->getLabel()][] = $week;
            if (get_class($exoPhase) === Race::class) {
                $this->planNo++;
            }
        }
        return $this;
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