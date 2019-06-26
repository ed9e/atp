<?php


namespace App\Garmin\Stock\Response;


use App\Mapper\Type\Response\ValuePath;

class Base
{
    protected $request;
    public function __construct(\App\Garmin\Stock\Request\Base $request)
    {
        $this->request = $request;
    }

    public function value(ValuePath $path)
    {
        $_data = $this->request->toArray();
        foreach ($path->getArray() as $pathKey) {
            if(!key_exists($pathKey, $_data)) {
                return null;
            }
            $_data = $_data[$pathKey];
        }
        return $_data;
    }
}