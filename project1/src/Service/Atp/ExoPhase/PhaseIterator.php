<?php


namespace App\Service\Atp\ExoPhase;


class PhaseIterator implements \Iterator
{
    /** @var array $phases */
    protected $phases = [];
    /** @var int $position */
    protected $position;

    public function __construct(array $phases)
    {
        $this->phases = $phases;
        $this->position = 0;
    }

    public function current(): PhaseAbstract
    {
        return $this->phases[$this->position];
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