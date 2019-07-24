<?php


namespace App\Command\Traits;


class ActionMapElement
{
    protected $functionName;
    protected $info;

    public function __construct($functionName)
    {
        $this->functionName = $functionName;
    }

    public function __toString()
    {
        return $this->getFunctionName() . ' => ' . $this->getInfo();
    }

    /**
     * @return mixed
     */
    public function getFunctionName()
    {
        return $this->functionName;
    }

    /**
     * @param mixed $functionName
     */
    public function setFunctionName($functionName): void
    {
        $this->functionName = $functionName;
    }

    /**
     * @return mixed
     */
    public function getInfo()
    {
        return $this->info;
    }

    /**
     * @param mixed $info
     * @return ActionMapElement
     */
    public function setInfo($info)
    {
        $this->info = $info;
        return $this;
    }
}