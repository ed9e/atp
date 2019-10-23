<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ControlSidebarController extends AbstractController
{
    /**
     * @Route("/default", name="default")
     */
    public function index()
    {
        $data = [
            'users' => [
                ['username' => 'lbrzozowski'],
                ['username' => 'faramka'],
                ['username' => 'rpasieczny'],
                ['username' => 'dziorki'],
                ['username' => 'MichalHarnik'],
                ['username' => 'Leprecian'],
                ['username' => 'ad478d14-a089-43a8-a9a4-0e964917a6fc'], //aga
                ['username' => 'da2a7a64-c01c-4f9b-b2bc-dbff1eaf559a'], //Jerzy
            ]
        ];
        return $this->render('control-sidebar/home.html.twig', $data);
    }
}
