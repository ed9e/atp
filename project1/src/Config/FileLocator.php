<?php


namespace App\Config;


use Symfony\Component\Config\FileLocatorInterface;

class FileLocator implements FileLocatorInterface
{
    protected $configDirectories = [__DIR__ . '/config'];

    public function locate($name, $currentPath = null, $first = true)
    {
        $fileLocator = new \Symfony\Component\Config\FileLocator($this->configDirectories);
        return $fileLocator->locate($name, $currentPath, $first);
    }
}