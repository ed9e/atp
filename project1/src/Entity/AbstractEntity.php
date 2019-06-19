<?php


namespace App\Entity;


use App\Entity\Exception\UnexpectedProperty;

abstract class AbstractEntity
{
    public function __set(string $name, $value)
    {
        $function_name = 'set' . mb_convert_case($name, MB_CASE_TITLE);

        if (!method_exists($this, $function_name)) {
            throw new UnexpectedProperty();
        }
        $this->$function_name($value);
    }
}