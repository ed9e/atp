<?php


namespace App\Mapper\Type\Response;


use App\Mapper\Type\Response\Indicator\ActivityType;

class ActivityTypeMap extends MapAbstract implements MapInterface

{

    protected $efi;
    protected $path;

    public function __construct(ActivityType $efi, ValuePath $path)
    {
        $this->setEfi($efi);
        $this->setPath($path);
    }

    public function getEfi(): ActivityType
    {
        return $this->efi;
    }

    public function setEfi(ActivityType $efi): ActivityTypeMap
    {
        $this->efi = $efi;
        return $this;
    }

    /**
     * @return ValuePath
     */
    public function getPath(): ValuePath
    {
        return $this->path;
    }

    public function setPath(ValuePath $path): ActivityTypeMap
    {
        $this->path = $path;
        return $this;
    }

}