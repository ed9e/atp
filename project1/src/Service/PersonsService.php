<?php


namespace App\Service;


class PersonsService
{
    public function get()
    {
        $data = [
            ['name' => 'Łukasz', 'username' => 'lbrzozowski'],
            ['name' => 'FAramka', 'username' => 'faramka'],
            ['name' => 'Skoor', 'username' => 'Skoor'],
            ['name' => 'Robert', 'username' => 'rpasieczny'],
            ['name' => 'Krzemiński', 'username' => 'krzemyk11'],
            ['name' => 'Dziorek', 'username' => 'dziorki'],
            ['name' => 'Harnik', 'username' => 'MichalHarnik'],
            ['name' => 'Henek', 'username' => 'Leprecian'],
            ['name' => 'Aga', 'username' => 'ad478d14-a089-43a8-a9a4-0e964917a6fc'], //aga
            ['name' => 'Jerzy', 'username' => 'da2a7a64-c01c-4f9b-b2bc-dbff1eaf559a'], //Jerzy
        ];
        return $data;
    }
}