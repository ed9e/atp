<?php


namespace App\Service;


class NotesService
{
    public static function getNotes()
    {
        $notes = [
            '2017-03-11' => '12h w Kopalni Soli',
            '2019-01-26' => 'ZMB 2019',
            '2018-01-28' => 'ZMB 2018',
            '2019-05-18' => 'UltraRoztocze 65k',
            '2019-09-02' => 'Gorzycka 5',
            '2019-09-28' => 'Chartatywna 20',
            '2019-10-12' => 'UltraMaraton 52k',
            '2020-01-12' => 'Zimowe Roztocze',
            '2020-05-03' => '5K Test',
            '2020-07-06' => 'Bojko Trail',
            '2020-08-20' => 'VI ULTRAMARATON MAGURSKI',
            '2020-10-10' => 'UltraMaraton 52k',
        ];
        return array_map(static function ($n) {
            return substr($n, 0, 16);
        }, $notes);
    }
}