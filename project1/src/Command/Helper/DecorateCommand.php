<?php
namespace App\Command\Helper;

trait DecorateCommand
{
    public function decorate(&$message, $tag)
    {
        $message = (array)$message;
        array_walk($message, function (&$v, $k, $tag) {
            $v = '<'.$tag.'>'.$v.'</'.$tag.'>';
        }, $tag);
    }

}