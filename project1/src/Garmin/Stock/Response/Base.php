<?php


namespace App\Garmin\Stock\Response;


use App\Mapper\Type\Response\ValuePath;

class Base
{
    protected $arrayContent;
    public function __construct(array $arrayContent)
    {
        $this->arrayContent = $arrayContent;
    }

    public function value(ValuePath $path)
    {
        $_data = $this->arrayContent;
        foreach ($path->getArray() as $pathKey) {
            if(!key_exists($pathKey, $_data)) {
                return null;
            }
            $_data = $_data[$pathKey];
        }
        return $_data;
    }
}