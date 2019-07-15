<?php


namespace App\Config;


use App\Config\Loader\DelegatingLoader;
use App\Config\Loader\YamlLoader;

use Symfony\Component\Config\Loader\LoaderResolver;

class Service
{
    public const RESOURCE_SESSION_CONFIG = 'session.yaml';
    public const SESSION_KEY_ID = 'session_id';
    protected $delegatingLoader;

    public function __construct(FileLocator $fileLocator)
    {

        $loaderResolver = new LoaderResolver([new YamlLoader($fileLocator)]);
        $this->delegatingLoader = new DelegatingLoader($loaderResolver);
    }

    public function load($resource, $key): ?string
    {
        try {
            $array = $this->delegatingLoader->load($resource);
            if(array_key_exists($key, $array))
            {
                return $array[$key];
            }
            throw new \Exception('Array key not exists!');
        } catch (\Exception $e) {
            return null;
        }
    }

    public function save($key, $value, $resource): ?string
    {

        try {
            return $this->delegatingLoader->save($key, $value, $resource);
        } catch (\Exception $e) {
            return null;
        }
    }
}