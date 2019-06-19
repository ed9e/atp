<?php


namespace App\Mapper\Response;


use App\Mapper\Response\EntityFieldIndicator as EFI;

class Mapper
{
    protected $response;
    protected $mapIterator;

    private $fieldPath;
    private $inc;

    public function __construct()
    {
        $this->mapIterator = new EntityFieldMapIterator();
        $this->reverseFieldsMap();
    }

    public function getResponse()
    {
        return $this->response;
    }

    public function getMap()
    {
        return $this->mapIterator;
    }

    public function reverseFieldsMap()
    {
        $this->reverse($this->response, 0, 1);
    }

    protected function reverse($array, $fkey = 0, $level = 1)
    {
        $this->inc++;
        foreach ($array as $key => $value) {

            if (is_array($value)) {
                $this->fieldPath[$this->inc] = $key;
                $this->reverse($value, $key, $level + 1);
            } else {
                if ($value instanceof EFI) {
                    $this->fieldPath[$this->inc] = $key;
                    $this->mapIterator->add(new EntityFieldMap($value, $this->fieldPath));
                }
                unset($this->fieldPath[$this->inc]);
            }
        }
        $this->inc--;
        unset($this->fieldPath[$this->inc]);
    }
}