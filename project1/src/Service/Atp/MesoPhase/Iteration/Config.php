<?php


namespace App\Service\Atp\MesoPhase\Iteration;


class Config
{
    protected $value;
    protected $min;
    protected $max;

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     * @return Config
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMin()
    {
        return $this->min;
    }

    /**
     * @param mixed $min
     * @return Config
     */
    public function setMin($min)
    {
        $this->min = $min;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMax()
    {
        return $this->max;
    }

    /**
     * @param mixed $max
     * @return Config
     */
    public function setMax($max)
    {
        $this->max = $max;
        return $this;
    }

}