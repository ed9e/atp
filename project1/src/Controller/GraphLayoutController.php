<?php

namespace App\Controller;


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
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */
    public function personsapiAction(Request $request): JsonResponse
    {
        $data = [
            'users' => [
                ['name' => 'Łukasz', 'username' => 'lbrzozowski'],
                ['name' => 'FAramka', 'username' => 'faramka'],
                ['name' => 'Robert', 'username' => 'rpasieczny'],
                ['name' => 'Dziorek', 'username' => 'dziorki'],
                ['name' => 'Harnik', 'username' => 'MichalHarnik'],
                ['name' => 'Henek', 'username' => 'Leprecian'],
                ['name' => 'Aga', 'username' => 'ad478d14-a089-43a8-a9a4-0e964917a6fc'], //aga
                ['name' => 'Jerzy', 'username' => 'da2a7a64-c01c-4f9b-b2bc-dbff1eaf559a'], //Jerzy
            ]
        ];
        return $this->json($data['users']);
    }
}