<?php

namespace App\Service;


use App\Config\Service;

class GarminConfig
{
    protected $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    /**
     * @param Service $service
     * @return GarminConfig
     */
    public function setService(Service $service): GarminConfig
    {
        $this->service = $service;
        return $this;
    }

    public function getSession(): ?string
    {
        return $this->service->load($this->service::RESOURCE_SESSION_CONFIG, $this->service::SESSION_KEY_ID);
    }
}