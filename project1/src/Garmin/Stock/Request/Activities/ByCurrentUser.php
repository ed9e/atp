<?php


namespace App\Garmin\Stock\Request\Activities;

class ByCurrentUser extends AbstractActivities
{
    protected $uri = 'https://connect.garmin.com/modern/proxy/activitylist-service/activities/search/activities?limit={limit}&start={start}';

}