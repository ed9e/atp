<?php


namespace App\Service\Atp;


use DateTime;

class ATP
{
    /** @var Plan */
    protected $plan;
    protected $data;
    protected $groupPhases;

    /**
     * @return Plan
     */
    public function getPlan(): Plan
    {
        return $this->plan;
    }

    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    protected $atp;

    public function plan(array $options)
    {

        $this->plan = new Plan([
            'from' => $options['from'],
            'to' => $options['to']
        ]);
        return $this;
    }

    public function fetchPlan()
    {
        $this->data = array_reverse($this->plan->create()->fetch()->getTimeValueByWeek());
        $this->groupPhases = $this->plan->getCalendar()->getGroupedExoPhase();
        return $this;
    }

    public function fetchData()
    {
        $this->data = ['2020-08-30' => 155, '2020-09-06' => 315, '2020-09-13' => 345, '2020-09-20' => 165, '2020-09-27' => 270, '2020-10-04' => 315, '2020-10-11' => 345, '2020-10-18' => 165, '2020-10-25' => 280, '2020-11-01' => 325, '2020-11-08' => 355, '2020-11-15' => 165, '2020-11-22' => 280, '2020-11-29' => 325, '2020-12-06' => 355, '2020-12-13' => 165, '2020-12-20' => 335, '2020-12-27' => 365, '2021-01-03' => 165, '2021-01-10' => 290, '2021-01-17' => 335, '2021-01-24' => 365, '2021-01-31' => 165, '2021-02-07' => 290, '2021-02-14' => 335, '2021-02-21' => 365, '2021-02-28' => 165, '2021-03-07' => 290, '2021-03-14' => 335, '2021-03-21' => 365, '2021-03-28' => 165, '2021-04-04' => 315, '2021-04-11' => 315, '2021-04-18' => 315, '2021-04-25' => 155, '2021-05-02' => 315, '2021-05-09' => 315, '2021-05-16' => 155, '2021-05-23' => 315, '2021-05-30' => 315, '2021-06-06' => 315, '2021-06-13' => 155, '2021-06-20' => 255, '2021-06-27' => 240,];
        return $this;
    }

    public function getDone()
    {
        return [
            '2019-08-05' => 238,
            '2019-07-29' => 154,
            '2019-07-22' => 201,
            '2019-07-15' => 249,
            '2019-07-08' => 101,
            '2019-07-01' => 249,
            '2019-06-24' => 278,
            '2019-06-17' => 116,
            '2019-06-10' => 213,
        ];

    }

    public function rework()
    {
        $prev = $this->plan->createIntervalArrayByPrev($this->plan->getStart(), 'P2W');
        //$prev = [];
        $last = $this->plan->createIntervalArrayBy($this->plan->getEnd(), 'P2W');
        $keys = array_merge($prev, array_keys($this->data), $last);
        $values = array_values($this->data);
        $values = array_merge(array_fill_keys(array_keys($prev), 15), $values);
        $values = array_merge($values, array_fill_keys(array_keys($last), 15));


        $phases = array_flip(
            array_map(function ($x) {
                $from = (new DateTime(end($x)))->getTimestamp();
                $to = (new DateTime(reset($x) . '+0 days'))->getTimestamp();
                $diff = $to - $from;
                $halfTime = $from + floor($diff / 2);
                return date('Y-m-d', $halfTime);
            }, $this->groupPhases)
        );

        $phases2 = array_map(function ($x) {
            $from = (new DateTime(end($x) . '-4 days'))->format('Y-m-d');
            $to = (new DateTime(reset($x) . '+4 days'))->format('Y-m-d');
            return [$from, $to];
        }, $this->groupPhases);

        $diff = array_diff($keys, array_keys($this->getDone()));
        $done = array_merge(array_fill_keys($diff, 15), $this->getDone());
        ksort($done);
//        $done = array_values($done);
//        $done = $this->getDone();
        $this->atp = ['keys' => $keys, 'values' => $values, 'phases' => $phases, 'phases2' => $phases2, 'done' => $done];
        //$this->atp = ['keys' => $keys, 'values' => $values, 'phases' => [], 'phases2' => []];
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAtp()
    {
        return $this->atp;
    }
}