<?php


namespace App\Config\Loader;


use Symfony\Component\Config\Loader\FileLoader;
use Symfony\Component\Yaml\Yaml;

class YamlLoader extends FileLoader
{

    public function save($key, $value, $resource): bool
    {

        try {
            $values = $this->load($resource);
        } catch (\Exception $e) {
            $values = [];
        }
        $values[$key] = $value;
        $yaml = Yaml::dump($values);

        $located = $this->getLocator()->locate($resource);
        return file_put_contents($located, $yaml);
    }

    public function load($resource, $type = null): ?array
    {
        $located = $this->getLocator()->locate($resource);
        return Yaml::parse(file_get_contents($located));
    }

    public function supports($resource, $type = null): bool
    {
        return is_string($resource) && 'yaml' === pathinfo(
                $resource,
                PATHINFO_EXTENSION
            );
    }
}