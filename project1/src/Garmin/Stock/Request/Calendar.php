<?php


namespace App\Garmin\Stock\Request;


class Calendar extends Base
{
    protected $uri = 'https://connect.garmin.com/modern/proxy/calendar-service/year/2019/month/6';

    public function getCalendarItems()
    {
        return $this->toArray()['calendarItems'];
    }

    public function response(): \App\Garmin\Stock\Response\Base
    {
        return new \App\Garmin\Stock\Response\ActivityDetails($this);
    }
}