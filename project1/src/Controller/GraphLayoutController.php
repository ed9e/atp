<?php

namespace App\Controller;


use App\Service\PersonsService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class GraphLayoutController extends AbstractController
{
    public function personsAction(Request $request)
    {
        return $this->render('layout/persons.html.twig');
    }

    /**
     * @Route("/layout/personsapi")
     * @param PersonsService $service
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */
    public function personsapiAction(PersonsService $service, Request $request): JsonResponse
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        return $this->json($service->get());
    }
}