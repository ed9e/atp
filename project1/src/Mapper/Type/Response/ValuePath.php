<?php


namespace App\Mapper\Type\Response;


class ValuePath
{
    protected $array = [];

    public function __construct($array)
    {
        $this->array = $array;
    }

    /**
     * @return array
     */
    public function getArray(): array
    {
        return $this->array;
    }

    /**
     * @param array $array
     * @return ValuePath
     */
    public function setArray(array $array): ValuePath
    {
        $this->array = $array;
        return $this;
    }

}