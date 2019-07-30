<?php


namespace App\Service\Atp;

use App\Service\Atp\ExoPhase\PhaseIterator;
use DateInterval;
use DatePeriod;
use DateTime;
use Exception;

class Plan
{
    public function create(array $options): Calendar
    {
        $start = new DateTime($options['from']);
        $end = new DateTime($options['to']);

        $interval = new DateInterval('P7D');
        $period = new DatePeriod($start, $interval, $end);

        //dump(iterator_count($period));
        $dateArray = [];
        foreach ($period as $date) {
            $dateArray[] = $date->format('Y-m-d');
        }
        $reversedDates = array_reverse($dateArray);
        $calendar = new Calendar($reversedDates);
        /** Składowe jakie będą brały udział w tworzeniu planu */
        $phasesComponent = new Component($calendar);
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

        $calendar->fill($phasesIterator);
        return $calendar;
    }
}