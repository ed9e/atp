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
            ['from' => '2019-10-25',
                'to' => '2020-01-10'],
            ['from' => '2020-01-10',
                'to' => '2020-07-05'],
            ['from' => '2020-07-05',
                'to' => '2020-10-10'],
        ])->fetchPlan()->rework();
        $atpPlan = $this->atp->getAtp();

        $atpPlan['flags'] = NotesService::getNotes();

        return $atpPlan;
    }

}