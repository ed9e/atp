<?php

namespace App\Controller;

use KevinPapst\AdminLTEBundle\Event\SidebarMenuEvent;
use KevinPapst\AdminLTEBundle\Event\ThemeEvents;
use KevinPapst\AdminLTEBundle\Model\MenuItemInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BreadcrumbController extends \KevinPapst\AdminLTEBundle\Controller\BreadcrumbController
{
    public function breadcrumbAction(Request $request)
    {
        if (!$this->getDispatcher()->hasListeners(ThemeEvents::THEME_BREADCRUMB)) {
            return new Response();
        }

        /** @var SidebarMenuEvent $event */
        $event = $this->getDispatcher()->dispatch(ThemeEvents::THEME_BREADCRUMB, new SidebarMenuEvent($request));
        /** @var MenuItemInterface $active */
        $active = $event->getActive();
        $list = [];
        if (null !== $active) {
            $list[] = $active;
            while (null !== ($item = $active->getActiveChild())) {
                $list[] = $item;
                $active = $item;
            }
        }
        return $this->render('breadcrumb.html.twig', [
            'active' => $list,
        ]);
    }
}
