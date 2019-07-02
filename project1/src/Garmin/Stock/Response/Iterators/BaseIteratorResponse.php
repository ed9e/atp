<?php


namespace App\Garmin\Stock\Response\Iterators;

use Iterator as Iterator;

abstract class BaseIteratorResponse implements Iterator
{
    protected $position;

    public function __construct()
    {
        $this->position = 0;
    }

    abstract public function current();


    public function next()
    {
        // TODO: Implement next() method.
    }

    public function key()
    {
        // TODO: Implement key() method.
    }

    public function valid()
    {
        // TODO: Implement valid() method.
    }

    public function rewind()
    {
        // TODO: Implement rewind() method.
    }
}