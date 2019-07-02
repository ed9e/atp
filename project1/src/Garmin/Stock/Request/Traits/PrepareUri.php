<?php


namespace App\Garmin\Stock\Request\Traits;


use App\Garmin\Stock\Exception\MethodNotExist;
use App\Garmin\Stock\Exception\ParameterNotSet;

trait PrepareUri
{

    protected function prepareUri()
    {
        parent::prepareUri();
        preg_match_all('/({[a-zA-Z0-9_]+})/i', $this->uri, $matches);
        foreach ($matches[1] as $match) {
            $token = trim($match, '{}');
            $method = 'get' . ucfirst($token);
            if (!method_exists($this, $method)) {
                throw new MethodNotExist(get_class($this) . '->' . $method);
            }
            $value = $this->$method();
            if (!isset($value)) {
                throw new ParameterNotSet(get_class($this) . '->' . $method);
            }
            $this->uri = str_replace('{'.$token.'}', $value, $this->uri);
        }

    }
}