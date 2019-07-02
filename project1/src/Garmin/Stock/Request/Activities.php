<?php


namespace App\Garmin\Stock\Request;

use App\Garmin\Stock\Request\Traits\PrepareUri;
use App\Garmin\Stock\Response\Iterators\ActivitiesIterator;
use App\Garmin\Stock\Response\Iterators\BaseIteratorResponse;

class Activities extends Base
{
    use PrepareUri;

    protected $activityType = '';
    protected $start = 1600;
    protected $limit = 100;
    protected $uri = 'https://connect.garmin.com/modern/proxy/activitylist-service/activities/search/activities?limit={limit}&start={start}';

    /**
     * @return string
     */
    public function getActivityType(): string
    {
        return $this->activityType;
    }

    /**
     * @param string $activityType
     * @return Activities
     */
    public function setActivityType(string $activityType): Activities
    {
        $this->activityType = $activityType;
        return $this;
    }

    /**
     * @return string
     */
    public function getStart(): string
    {
        return $this->start;
    }

    /**
     * @param string $start
     * @return Activities
     */
    public function setStart(string $start): Activities
    {
        $this->start = $start;
        return $this;
    }

    /**
     * @return string
     */
    public function getLimit(): string
    {
        return $this->limit;
    }

    /**
     * @param string $limit
     * @return Activities
     */
    public function setLimit(string $limit): Activities
    {
        $this->limit = $limit;
        return $this;
    }

    /**
     * @return string
     */
    public function getUri(): string
    {
        return $this->uri;
    }

    /**
     * @param string $uri
     * @return Activities
     */
    public function setUri(string $uri): Activities
    {
        $this->uri = $uri;
        return $this;
    }

    public function response(): BaseIteratorResponse
    {
        return new ActivitiesIterator($this);
    }
}