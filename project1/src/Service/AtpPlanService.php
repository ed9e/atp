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
                'to' => '2020-01-11',],
            ['from' => '2020-01-11',
                'to' => '2020-05-03',],
            ['from' => '2020-05-03',
                'to' => '2020-10-13',],
        ])->fetchPlan()->rework();
        $atpPlan = $this->atp->getAtp();

        $notes = [
            '2017-03-11' => '12h w Kopalni Soli',
            '2019-01-26' => 'ZMB 2019',
            '2018-01-28' => 'ZMB 2018',
            '2019-05-18' => 'UltraRoztocze 65k',
            '2019-09-02' => 'Gorzycka 5',
            '2019-09-28' => 'Chartatywna 20',
            '2019-10-12' => 'UltraMaraton 52k',
        ];

        $atpPlan['flags'] = $notes;

        return $atpPlan;
    }

}