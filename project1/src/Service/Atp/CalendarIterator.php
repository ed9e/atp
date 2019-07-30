<?php


namespace App\Service\Atp;


class CalendarIterator
{
    protected $plan = [];

    /** @var int $position */
    protected $position;

    public function __construct()
    {
        $this->position = 0;
    }

    public function current()
    {
        return $this->plan[$this->position];
    }

    public function next(): void
    {
        ++$this->position;
    }

    public function key(): int
    {
        return $this->position;
    }

    public function valid(): bool
    {
        return isset($this->phases[$this->position]);
    }

    public function rewind(): void
    {
        $this->position = 0;
    }
}