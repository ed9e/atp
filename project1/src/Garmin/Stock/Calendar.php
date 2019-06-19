<?php


namespace App\Garmin\Stock;

use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\BrowserKit\CookieJar;
use Symfony\Component\HttpClient\HttpClient;


class Calendar extends Base
{
    protected $uri = 'https://connect.garmin.com/modern/proxy/calendar-service/year/2019/month/4';

    public function getCalendarItems()
    {
        return $this->toArray()['calendarItems'];
    }

}