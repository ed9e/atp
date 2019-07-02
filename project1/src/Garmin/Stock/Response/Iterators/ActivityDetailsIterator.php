<?php


namespace App\Garmin\Stock\Response\Iterators;


use App\Garmin\Stock\Response\ActivityDetails;

class ActivityDetailsIterator extends BaseIteratorResponse implements \Iterator
{
    protected $activities = [];

    public function __construct(\App\Garmin\Stock\Request\ActivityDetails $request)
    {
        parent::__construct();
        $this->add(new ActivityDetails($request));
    }

    public function add(ActivityDetails $activity)
    {
        $this->activities[] = $activity;
        return $this;
    }

    public function getActivities()
    {
        return $this->activities;
    }

    public function current(): ActivityDetails
    {
        return $this->activities[$this->position];
    }

    public function next()
    {
        ++$this->position;
    }

    public function key()
    {
        return $this->position;
    }

    public function valid()
    {
        return isset($this->activities[$this->position]);
    }

    public function rewind()
    {
        $this->position = 0;
    }
}