<?php


namespace App\Service\Atp\MicroPhase;


use ArrayAccess;
use Countable;
use Iterator;

class PhaseIterator implements Iterator, ArrayAccess, Countable
{
    /** @var array $phases */
    protected $phases = [];
    /** @var int $position */
    protected $position;
    protected $i = 0;

    public function __construct()
    {
        $this->position = 0;
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

    public function offsetExists($offset): bool
    {
        return isset($this->phases[$offset]);
    }

    public function offsetGet($offset): MicroPhase
    {
        return $this->phases[$offset] ?? null;
    }

    public function offsetSet($offset, $value): void
    {
        $this->i++;

        if ($offset === null) {
            $this->phases[] = $value;
        } else {
            $this->phases[$offset] = $value;
        }
    }

    public function count()
    {
        return count($this->phases);
    }

    public function pop()
    {
        array_pop($this->phases);
    }

    public function first()
    {
        $this->rewind();
        $phase = $this->current();
        $this->offsetUnset($this->position);
        $this->rewind();
        return $phase;
    }

    public function rewind(): void
    {
        reset($this->phases);
        $this->position = key($this->phases);
    }

    public function current(): MicroPhase
    {
        return $this->phases[$this->position];
    }

    public function offsetUnset($offset): void
    {
        unset($this->phases[$offset]);
    }

    public function end()
    {
        return end($this->phases);
    }

    public function push($array)
    {
        foreach (array_reverse($array) as $item) {
            $this->phases[] = $item;
        }

    }
}