<?php


namespace App\Service\Atp;


class ATP
{
    /** @var Plan */
    protected $plan;
    protected $data;
    protected $atp;

    public function createPlan(array $options)
    {
        
        $this->plan = new Plan([
            'from' => $options['from'],
            'to' => $options['to']
        ]);
        return $this;
    }

    public function fetchData()
    {
        $this->data = ['2020-08-30' => 155, '2020-09-06' => 315, '2020-09-13' => 345, '2020-09-20' => 165, '2020-09-27' => 270, '2020-10-04' => 315, '2020-10-11' => 345, '2020-10-18' => 165, '2020-10-25' => 280, '2020-11-01' => 325, '2020-11-08' => 355, '2020-11-15' => 165, '2020-11-22' => 280, '2020-11-29' => 325, '2020-12-06' => 355, '2020-12-13' => 165, '2020-12-20' => 335, '2020-12-27' => 365, '2021-01-03' => 165, '2021-01-10' => 290, '2021-01-17' => 335, '2021-01-24' => 365, '2021-01-31' => 165, '2021-02-07' => 290, '2021-02-14' => 335, '2021-02-21' => 365, '2021-02-28' => 165, '2021-03-07' => 290, '2021-03-14' => 335, '2021-03-21' => 365, '2021-03-28' => 165, '2021-04-04' => 315, '2021-04-11' => 315, '2021-04-18' => 315, '2021-04-25' => 155, '2021-05-02' => 315, '2021-05-09' => 315, '2021-05-16' => 155, '2021-05-23' => 315, '2021-05-30' => 315, '2021-06-06' => 315, '2021-06-13' => 155, '2021-06-20' => 255, '2021-06-27' => 240,];
        return $this;
    }

    public function rework()
    {
        $keys = array_merge(array_keys($this->data), $this->plan->createIntervalArrayBy($this->plan->getEnd(), 'P10W'));
        $values = array_values($this->data);
        $diff = array_diff($keys, $values);
        $values = array_merge($values, array_fill_keys(array_keys($diff), 15));
        $this->atp = ['keys' => $keys, 'values' => $values];
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