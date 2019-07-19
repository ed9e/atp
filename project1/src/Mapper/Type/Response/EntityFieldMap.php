<?php


namespace App\Mapper\Type\Response;


class EntityFieldMap extends MapAbstract implements MapInterface
{

    protected $efi;
    protected $path;


    public function getEfi(): EntityFieldIndicator
    {
        return $this->efi;
    }

    /**
     * @param EntityFieldIndicator $efi
     * @return EntityFieldMap
     */
    public function setEfi(EntityFieldIndicator $efi): EntityFieldMap
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

    /**
     * @param ValuePath $path
     * @return EntityFieldMap
     */
    public function setPath(ValuePath $path): EntityFieldMap
    {
        $this->path = $path;
        return $this;
    }

    public function __construct(EntityFieldIndicator $efi, ValuePath $path)
    {
        $this->setEfi($efi);
        $this->setPath($path);
    }

}