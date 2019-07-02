<?php


namespace App\Garmin\Stock\Request;


use App\Garmin\Stock\Request\Traits\PrepareUri;

class Calendar extends Base
{
    use PrepareUri;

    protected $uri = 'https://connect.garmin.com/modern/proxy/calendar-service/year/{year}/month/{month}';
    protected $month = null;
    protected $year = null;

    /**
     * @return mixed
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param mixed $year
     * @return Calendar
     */
    public function setYear($year)
    {
        $this->year = $year;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMonth()
    {
        return $this->month;
    }

    /**
     * @param mixed $month
     * @return Calendar
     */
    public function setMonth($month)
    {
        $this->month = $month;
        return $this;
    }

    public function getCalendarItems()
    {
        return $this->toArray()['calendarItems'];
    }

    public function response(): \App\Garmin\Stock\Response\Base
    {
        return new \App\Garmin\Stock\Response\ActivityDetails($this);
    }


}