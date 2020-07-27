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
            ['from' => '2020-07-20',
                'to' => '2020-10-10'],
            ['from' => '2020-10-12',
                'to' => '2021-02-06'],

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
