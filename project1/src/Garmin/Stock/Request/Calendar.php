<?php


namespace App\Garmin\Stock\Request;


class Calendar extends Base
{
    protected $month;

    /**
     * @return mixed
     */
    public function getMonth()
    {
        return $this->month;
    }

    /**
     * @param mixed $month
     */
    public function setMonth($month): void
    {
        $this->month = $month;
    }

    protected $uri = 'https://connect.garmin.com/modern/proxy/calendar-service/year/2019/month/{month}';

    protected function prepareUri()
    {
        parent::prepareUri();
        if (!$this->month) {
            throw new \Exception('Month not set');
        }
        $this->uri = str_replace('{month}', $this->month, $this->uri);
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