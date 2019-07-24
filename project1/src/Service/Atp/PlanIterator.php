<?php


namespace App\Service\Atp;


class PlanIterator implements \Iterator
{
    public const FIRST_ITERATION = 0;
    public const SECOND_ITERATION = 1;
    public const THIRD_ITERATION = 2;
    public const FOURTH_ITERATION = 3;

    protected $iterations = [];
    protected $position = 0;

    public function __construct(int $iterationsCount = 3)
    {
        $this->setIterations($iterationsCount);
    }

    public function setIterations(int $iterationsCount): PlanIterator
    {
        $this->iterations = array_fill(0, $iterationsCount, []);
        return $this;
    }

    public function current()
    {
        return $this->iterations[$this->position];
    }

    public function next(): void
    {
        ++$this->position;
    }

    public function key()
    {
        return $this->position;
    }

    public function valid(): bool
    {
        return isset($this->iterations[$this->position]);
    }

    public function rewind(): void
    {
        $this->position = 0;
    }

}