<?php

namespace App\Service;

use App\Service\Atp\ATP;
use Symfony\Component\HttpFoundation\RequestStack;

class AtpPlanService
{
    protected $request;
    protected $atp;

    public function __construct(RequestStack $request, ATP $atp)
    {
        $this->request = $request->getCurrentRequest();
        $this->atp = $atp;
    }

    public function getWeekly(): array
    {
        $this->atp->plan([
            ['from' => '2019-10-02',
                'to' => '2020-05-01',],
            ['from' => '2020-05-08',
                'to' => '2020-10-12',],
        ])->fetchPlan()->rework();
        $atpPlan1 = $this->atp->getAtp();

//        $this->atp->plan([
//            'from' => '2020-05-01',
//            'to' => '2020-10-12',
//        ])->fetchPlan()->rework();
//        $atpPlan2 = $this->atp->getAtp();

        $keys = $atpPlan1['keys'];
        $done = $atpPlan1['done'];
        $values = $atpPlan1['values'];
        $phases2 = $atpPlan1['phases2'];
        $phases = $atpPlan1['phases'];
        $diff = array_diff($keys, array_keys($values));

        $values = array_merge(array_fill_keys($diff, 0), $values);
        ksort($values);

        $notes = [
            '2017-03-11' => '12h w Kopalni Soli',
            '2019-01-26' => 'ZMB 2019',
            '2018-01-28' => 'ZMB 2018',
            '2019-05-18' => 'UltraRoztocze 65k',
            '2019-09-02' => 'Gorzycka 5',
            '2019-09-28' => 'Chartatywna 20',
            '2019-10-12' => 'UltraMaraton 52k',
        ];

        $atpPlan = [
            'keys' => $keys,
            'done' => $done,
            'values' => $values,
            'phases' => $phases,
            'phases2' => $phases2,
            'flags' => $notes
        ];

        return $atpPlan;
    }

}