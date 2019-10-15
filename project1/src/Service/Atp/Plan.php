<?php


namespace App\Service\Atp;

use App\Service\Atp\ExoPhase\PhaseIterator;
use DateInterval;
use DatePeriod;
use DateTime;
use Exception;

class Plan
{
    protected $start;
    protected $end;
    protected $calendar;
    protected $request;
    protected $options;

    /**
     * @return mixed
     */
    public function getCalendar(): Calendar
    {
        return $this->calendar;
    }


    public function __construct($options, $request)
    {
        $this->options = $options;
        foreach ($options as $dates) {
            $this->start[] = $dates['from'];
            $this->end[] = $dates['to'];
        }

        $this->request = $request;
    }

    public function getStart($i)
    {
        return $this->start[$i];
    }

    public function getEnd($i)
    {
        return $this->end[$i];
    }

    public function create(array $options = null): Calendar
    {
        $this->calendar = new Calendar($this->request);
        foreach ($this->options as $dates) {

            $dateArray = $this::createIntervalArray($dates['from'], $dates['to']);

            $reversedDates = array_reverse($dateArray);

            $this->calendar->addWeeks($reversedDates);
            /** Składowe jakie będą brały udział w tworzeniu planu */
            $phasesComponent = new Component($this->calendar);
            /** Liczba iteracji do stworzenia planu */
            $planIterator = new PlanIterator(7);

            $phasesIterator = new PhaseIterator($phasesComponent->getPhases());

            foreach ($planIterator as $iterationNo => $iteration) {

                foreach ($phasesIterator as $phase) {
                    try {
                        /** Zabieranie wolnych mikrofaz */
                        $phase->getPlaceTaker()->takePlace($iterationNo);
                    } catch (Exception $e) {

                    }
                }
            }

            $this->calendar->fill($phasesIterator);
        }

        return $this->calendar;
    }

    public static function createIntervalArray($start, $end, $interval_spec = 'P7D'): array
    {
        if (!($start instanceof DateTime)) {
            $start = new DateTime($start);
        }
        if (!($end instanceof DateTime)) {
            $end = new DateTime($end);
        }

        $interval = new DateInterval($interval_spec);
        $period = new DatePeriod($start, $interval, $end);

        //dump(iterator_count($period));
        $dateArray = [];
        foreach ($period as $date) {
            $dateArray[] = $date->format('Y-m-d');
        }
        return $dateArray;
    }

    public function createIntervalArrayBy($start, $by_interval_spec = 'P7D', $interval_spec = 'P7D'): array
    {
        if (!($start instanceof DateTime)) {
            $start = new DateTime($start);
        }

        $end = clone($start);
        $end->add(new DateInterval($by_interval_spec));

        return $this->createIntervalArray($start, $end);
    }

    public function createIntervalArrayByPrev($start, $by_interval_spec = 'P7D', $interval_spec = 'P7D'): array
    {
        $start = new DateTime($start);
        $end = clone($start);
        $end->sub(new DateInterval($by_interval_spec));

        return $this->createIntervalArray($end, $start);
    }
}