<?php


namespace App\Garmin\Stock\Response\Iterators;

use App\Garmin\Stock\Request\InterfaceRequestStockGarmin;
use App\Garmin\Stock\Response\Activity;

class ActivitiesIterator extends BaseIteratorResponse implements \Iterator
{

    protected $activities = [];

    public function __construct(InterfaceRequestStockGarmin $request)
    {
        parent::__construct();

        foreach ($request->toArray() as $item) {
            $this->add(new Activity($item));
        }

    }

    public function add(Activity $activity)
    {
        $this->activities[] = $activity;
        return $this;
    }

    public function getActivities()
    {
        return $this->activities;
    }

    public function current(): Activity
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