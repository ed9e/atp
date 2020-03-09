<?php


namespace App\Service;


class NotesService
{
    public static function getNotes()
    {
        return array_map(static function ($n) {
            return substr($n, 0, 16);
        }, self::get());
    }

    public static function get()
    {
        return [
            '2017-03-11' => '12h w Kopalni Soli',
            '2019-01-26' => 'ZMB 2019',
            '2018-01-28' => 'ZMB 2018',
            '2019-05-18' => 'UltraRoztocze 65k',
            '2019-09-02' => 'Gorzycka 5',
            '2019-09-28' => 'Chartatywna 20',
            '2019-10-12' => 'UltraMaraton 52k',
            '2020-01-12' => 'Zimowe Roztocze',
            '2020-03-28' => 'Powitanie Wiosny w Ramach IV Edycji Biegu o Puchar Leszka Bebło 12km',
            '2020-03-29' => 'Bieg wiosenny Bilcza 7,5km' ,
            '2020-05-16' => 'Ultra Roztocze 2020 +30k',
            '2020-07-06' => 'Bojko Trail 2020 +40k',
            '2020-09-06' => 'Gorzycka 5',
            '2020-10-10' => 'Ultra Maraton Bieszczadzki +50k',
        ];
    }

    public static function getCompetitions()
    {
        $notes = self::get();
        ksort($notes);
        $notes = array_reverse($notes);
        $competitions = [];
        foreach ($notes as $k => $v) {
            $competitions[] = [
                'date' => $k,
                'title' => $v
            ];
        }
        return $competitions;
    }
}
