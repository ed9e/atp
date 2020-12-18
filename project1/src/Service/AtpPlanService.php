<?php

namespace App\Service;

use App\Service\Atp\ATP;
use App\Service\Atp\ATPFetch;
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
            ['from' => '2019-12-13',
                'to' => '2020-01-11'],
            ['from' => '2020-01-11',
                'to' => '2020-07-05'],
            ['from' => '2020-07-05',
                'to' => '2020-10-17'],
        ])->fetchPlan()->rework();
        $atpPlan = $this->atp->getAtp();

        $atpPlan['flags'] = NotesService::getNotes();

        return $atpPlan;
    }

    public function getFetch()
    {
        $atpFetch = new ATPFetch($this->request);
        $atpPlan = $atpFetch->fetchPlan()->rework()->getAtp();
        $atpPlan['flags'] = NotesService::getNotes();

        return $atpPlan;
    }

}
