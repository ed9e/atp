<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AtpLayoutController extends AbstractController
{
    public function plansAction(Request $request)
    {
        return $this->render('layout/plans.html.twig');
    }

    /**
     * @Route("/atplayout/plansapi")
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */
    public function plansapiAction(Request $request): JsonResponse
    {
        $data = [
            ['name' => 'Plan testowy', 'id' => 1],
            ['name' => 'Plan na poważnie :) hehe', 'id' => 2],
        ];
        return $this->json($data);
    }
}