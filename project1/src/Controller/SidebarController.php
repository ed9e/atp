<?php

namespace App\Controller;

use KevinPapst\AdminLTEBundle\Event\SidebarMenuEvent;
use KevinPapst\AdminLTEBundle\Event\ThemeEvents;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SidebarController extends \KevinPapst\AdminLTEBundle\Controller\SidebarController
{

    /**
     * @param Request $request
     * @return Response
     */
    public function menuAction(Request $request): Response
    {
        if (!$this->hasListener(SidebarMenuEvent::class)) {
            return new Response();
        }

        /** @var SidebarMenuEvent $event */
        $event = $this->dispatch(new SidebarMenuEvent($request));

        return $this->render(
            'Sidebar/menu.html.twig',
            [
                'menu' => $event->getItems(),
            ]
        );
    }
}
