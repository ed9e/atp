<?php


namespace App\Service\Atp;


class Calendar
{
    protected $weeks;
    protected $countWeeks;
    protected $weekPointer = 0;
    protected $calendar;

    /**
     * @return mixed
     */
    public function getCalendar()
    {
        return $this->calendar;
    }

    public function __construct($weeks)
    {
        $this->weeks = $weeks;
        $this->countWeeks = count($weeks);
    }

    public function setExoPhase($count, $exoPhaseName): void
    {
        while ($count > 0) {
            $count--;

            $this->calendar[$this->weeks[$this->weekPointer]] = $exoPhaseName;
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