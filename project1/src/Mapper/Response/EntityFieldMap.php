<?php


namespace App\Mapper\Response;


class EntityFieldMap
{

    protected $efi;
    protected $path;


    public function getEfi(): EntityFieldIndicator
    {
        return $this->efi;
    }

    /**
     * @param mixed $efi
     * @return EntityFieldMap
     */
    public function setEfi($efi)
    {
        $this->efi = $efi;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param mixed $path
     * @return EntityFieldMap
     */
    public function setPath($path)
    {
        $this->path = $path;
        return $this;
    }

    public function __construct($efi, $path)
    {
        $this->setEfi($efi);
        $this->setPath($path);
    }

}