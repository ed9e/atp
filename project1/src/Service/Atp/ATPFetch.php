<?php


namespace App\Service\Atp;


use App\Repository\AtpRepository;

class ATPFetch extends ATP
{
    public function fetchPlan(): ATP
    {
        /** @var AtpRepository $atpRepository */
        $atpRepository = $this->em->getRepository(\App\Entity\Atp::class);
        [$this->data, $this->groupPhases] = $atpRepository->getAtp();
        return $this;
    }

    public function rework(): ATP
    {
        $rework = new Rework($this);
        $reworked = $rework->getReworked();
        $this->atp = array_merge(['keys' => $this->getZoomKeys()], $reworked);
        return $this;
    }

    public function getAtp()
    {
        return $this->atp;
    }
}