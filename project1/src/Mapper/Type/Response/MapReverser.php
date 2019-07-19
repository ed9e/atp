<?php


namespace App\Mapper\Type\Response;


use App\Mapper\Type\Response\EntityFieldIndicator as EFI;
use App\Mapper\Type\Response\Indicator\ActivityType;

class MapReverser
{
    protected $responseMap;
    protected $mapIterator;
    protected $groupMapIterator;
    private $path;
    private $inc;

    public function __construct()
    {
        $this->mapIterator = new EntityFieldMapIterator();
        $this->groupMapIterator = new MapIterator();
        $this->reverseFieldsMap();
    }

    public function reverseFieldsMap()
    {
        $this->reverse($this->responseMap, 0, 1);
    }

    protected function reverse($array, $fkey = 0, $level = 1)
    {
        $this->inc++;
        foreach ($array as $key => $value) {

            if (is_array($value)) {
                $this->path[$this->inc] = $key;
                $this->reverse($value, $key, $level + 1);
            } else {

                if ($value instanceof GroupIndicator) {
                    //TODO:GroupIndicator jako Iterrator
                    foreach ($value->getArray() as $indicator) {
                        $this->groupMapIterator->add($indicator->createMap($this->path));
                    }
                }

                if ($value instanceof EFI) {
                    $this->path[$this->inc] = $key;

                    $this->mapIterator->add(new EntityFieldMap($value, new ValuePath($this->path)));
                }
                unset($this->path[$this->inc]);
            }
        }
        $this->inc--;
        unset($this->path[$this->inc]);
    }

    /**
     * @return MapIterator
     */
    public function getGroupMapIterator(): MapIterator
    {
        return $this->groupMapIterator;
    }

    /**
     * @param MapIterator $groupMapIterator
     * @return MapReverser
     */
    public function setGroupMapIterator(MapIterator $groupMapIterator): MapReverser
    {
        $this->groupMapIterator = $groupMapIterator;
        return $this;
    }

    public function getResponseMap()
    {
        return $this->responseMap;
    }

    public function getMap()
    {
        return $this->mapIterator;
    }

    public function strToTime($value)
    {
        return new \DateTime($value);
    }

    public function dumpp($value)
    {
        dump($value);
        return $value;
    }
}