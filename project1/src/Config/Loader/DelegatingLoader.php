<?php


namespace App\Config\Loader;


use Symfony\Component\Config\Exception\LoaderLoadException;
use Symfony\Component\Config\Loader\LoaderResolverInterface;

class DelegatingLoader extends \Symfony\Component\Config\Loader\DelegatingLoader
{
    public function __construct(LoaderResolverInterface $resolver)
    {
        parent::__construct($resolver);
        $this->resolver = $resolver;
    }

    public function save($key, $value, $resource)
    {
        /** @var YamlLoader $loader */
        $loader;
        if (false === $loader = $this->resolver->resolve($resource)) {
            throw new LoaderLoadException($resource);
        }

        return $loader->save($key, $value, $resource);
    }
}