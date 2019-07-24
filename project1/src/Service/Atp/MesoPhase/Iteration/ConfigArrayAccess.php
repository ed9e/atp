<?php


namespace App\Service\Atp\MesoPhase\Iteration;


class ConfigArrayAccess implements \ArrayAccess
{
    protected $configContainer = [];

    public function __construct(array $config)
    {
        $this->configContainer = $config;
    }

    public function offsetExists($offset): bool
    {
        return isset($this->configContainer[$offset]);
    }

    public function offsetGet($offset): Config
    {
        return $this->configContainer[$offset] ?? null;
    }

    public function offsetSet($offset, $value): void
    {
        if ($offset === null) {
            $this->configContainer[] = $value;
        } else {
            $this->configContainer[$offset] = $value;
        }
    }

    public function offsetUnset($offset): void
    {
        unset($this->configContainer[$offset]);
    }

}