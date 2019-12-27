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
            ['name' => 'Przemolec88', 'username' => 'Przemolec88'],
            ['name' => 'Henek', 'username' => 'Leprecian'],
            ['name' => 'Aga', 'username' => 'ad478d14-a089-43a8-a9a4-0e964917a6fc'],
            ['name' => 'Ozi', 'username' => '9b0f050b-414e-4292-92ac-7eebd193c635'],
            ['name' => 'Jerzy', 'username' => 'da2a7a64-c01c-4f9b-b2bc-dbff1eaf559a'],
            ['name' => 'Ania Pałacha', 'username' => '052f65ec-414a-4907-8f31-1663eafc7c27'],
            ['name' => 'Niejadalna', 'username' => '46090d95-2194-4cd3-9f51-8773540e499a'],
            ['name' => 'Harnik', 'username' => 'MichalHarnik'],
            ['name' => 'Krzemiński', 'username' => 'krzemyk11'],
            ['name' => 'Dziorek', 'username' => 'dziorki'],
            ['name' => 'Adam Krukar', 'username' => '36d9ef3f-5cf4-448e-a50c-3f985c7a488e'],
            ['name' => 'Bartosz Gorczyca', 'username' => 'BartoszGorczyca'],
            ['name' => 'Tomasz Frącz', 'username' => 'd595f243-60c9-4d87-8e69-35da58b40f9e'],
            ['name' => 'rudymariusz', 'username' => 'rudymariusz'],
        ];
        return $data;
    }
}
