<?php


namespace App\Mapper\Response;


class EntityFieldMapIterator implements \Iterator
{
    protected $position;
    protected $array = [];

    public function add($element)
    {
        $this->array[] = $element;
    }

    public function __construct()
    {
        $this->position = 0;
    }

    public function rewind()
    {
        $this->position = 0;
    }

    public function current(): EntityFieldMap
    {
        return $this->array[$this->position];
    }

    public function key()
    {
        return $this->position;
    }

    public function next()
    {
        ++$this->position;
    }

    public function valid()
    {
        return isset($this->array[$this->position]);
    }
}