<?php


namespace App\Garmin\Stock\Request\Activities;


use App\Garmin\Stock\Request\Base;
use App\Garmin\Stock\Request\Traits\PrepareUri;
use App\Garmin\Stock\Response\Iterators\ActivitiesIterator;
use App\Garmin\Stock\Response\Iterators\BaseIteratorResponse;

abstract class AbstractActivities extends Base
{
    use PrepareUri;

    protected $start = 0;
    protected $limit = 100;
    protected $activityType = '';

    /**
     * @return int
     */
    public function getStart(): int
    {
        return $this->start;
    }

    /**
     * @param int $start
     * @return AbstractActivities
     */
    public function setStart(int $start): AbstractActivities
    {
        $this->start = $start;
        return $this;
    }

    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }

    /**
     * @param int $limit
     * @return AbstractActivities
     */
    public function setLimit(int $limit): AbstractActivities
    {
        $this->limit = $limit;
        return $this;
    }

    /**
     * @return string
     */
    public function getActivityType(): string
    {
        return $this->activityType;
    }

    /**
     * @param string $activityType
     * @return AbstractActivities
     */
    public function setActivityType(string $activityType): AbstractActivities
    {
        $this->activityType = $activityType;
        return $this;
    }

    public function response(): BaseIteratorResponse
    {
        return new ActivitiesIterator($this);
    }
}