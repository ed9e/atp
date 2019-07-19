<?php


namespace App\Mapper\Type\Response;


class GroupIndicator
{
    protected $array;

    /**
     * @return array
     */
    public function getArray(): array
    {
        return $this->array;
    }

    /**
     * @param array $array
     * @return GroupIndicator
     */
    public function setArray(array $array): GroupIndicator
    {
        $this->array = $array;
        return $this;
    }

    public function __construct(array $a)
    {
        $this->array = $a;
    }

    public function get($class)
    {
        foreach ($this->array as $value)
        {
            if(get_class($value) == $class)
            {
                return $value;
            }
        }
        return null;
    }

}