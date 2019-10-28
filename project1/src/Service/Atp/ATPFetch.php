<?php


namespace App\Service\Atp;


use App\Entity\WeeklyActivity;
use App\Repository\AtpRepository;
use Symfony\Component\HttpFoundation\Request;

class ATPFetch
{
    public function __construct(Request $request)
    {
    }

    public function fetchPlan()
    {
        $atpReposiztory = $this->em->getRepository(AtpRepository::class);
        return $this;
    }

    public function rework()
    {
        return $this;
    }

    public function getAtp(): array
    {
        return [];
    }
}