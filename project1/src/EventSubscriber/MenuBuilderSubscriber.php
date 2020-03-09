<?php
// src/EventSubscriber/MenuBuilderSubscriber.php
namespace App\EventSubscriber;

use KevinPapst\AdminLTEBundle\Event\SidebarMenuEvent;
use KevinPapst\AdminLTEBundle\Event\ThemeEvents;
use KevinPapst\AdminLTEBundle\Model\MenuItemModel;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class MenuBuilderSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            ThemeEvents::THEME_SIDEBAR_SETUP_MENU => ['onSetupMenu', 100],
            //ThemeEvents::THEME_BREADCRUMB => ['onSetupMenu', 100],
        ];
    }

    public function onSetupMenu(SidebarMenuEvent $event)
    {
        $this->curtain($event);
        $this->dashboard($event);
        $this->atp($event);
        $this->race($event);
//        $this->herbs($event);
//        $this->analize($event);


        $this->activateByRoute(
            $event->getRequest()->get('_route'),
            $event->getItems()
        );
    }

    protected function curtain(SidebarMenuEvent $event): void
    {
        $model = new MenuItemModel('curtainId', 'Curtain', null, [], 'fas fa-adjust');
        $event->addItem($model);
    }

    protected function dashboard(SidebarMenuEvent $event): void
    {
        $atpMenu = new MenuItemModel('dashboardId', 'Dashboard', null, [], 'fas fa-cookie-bite');
        $atpMenu
            ->addChild(
                new MenuItemModel('currentId', 'Current fitness score', 'app_dashboard_index', [], 'fas fa-ruler')
            );
//             ->addChild(
//                new MenuItemModel('calendarId', 'Calendar', 'app_dashboard_calendar', [], 'far fa-calendar-alt')
//            )->addChild(
//                new MenuItemModel('statisticsId', 'Statistics', 'app_dashboard_statistics', [], 'fas fa-chart-line') //chart-pie chart-area chart-bar
//            );

        $event->addItem($atpMenu);
    }

    protected function atp(SidebarMenuEvent $event): void
    {
        $atpMenu = new MenuItemModel('atpId', 'Atp', null, [], 'fas fa-globe');

        $atpMenu->addChild(
            new MenuItemModel('planId', 'Let\'s Plan', 'app_atp_index', [], 'fas  fa-edit')
        )->addChild(
            new MenuItemModel('plans', 'Planed', '/atp/fetch', [], 'fas fa-hourglass-end')
        );

        $event->addItem($atpMenu);
    }

    protected function race(SidebarMenuEvent $event): void
    {
        $menu = new MenuItemModel('raceId', 'Competitions', '/race', [], 'fas fa-list');
        $event->addItem($menu);
    }

    /**
     * @param string $route
     * @param MenuItemModel[] $items
     */
    protected function activateByRoute($route, $items): void
    {
        foreach ($items as $item) {
            if ($item->hasChildren()) {
                $this->activateByRoute($route, $item->getChildren());
            } elseif ($item->getRoute() == $route) {
                $item->setIsActive(true);
            }
        }
    }

    protected function herbs(SidebarMenuEvent $event)
    {
        $menu = new MenuItemModel('herbs', 'Zioła', null, [], 'fas fa-industry');

        $menu
            ->addChild(
                new MenuItemModel('herbsId', 'Plan', '/herbs', [], 'fas fa-hourglass-start')
            )
            ->addChild(
                (new MenuItemModel('herbsListId', 'Lista', '/herbs/list', [], 'fas fa-hourglass-end'))
                    ->addChild(new MenuItemModel('rozeniecId', 'Różeniec górski', '/herbs/rozeniec_gorski', [], 'fas fa-hourglass-end'))
                    ->addChild(new MenuItemModel('pokrzywaId', 'Pokrzywa', '/herbs/pokrzywa', [], 'fas fa-hourglass-end'))
            )
            ->addChild(
                new MenuItemModel('examineId', 'Done', '/herbs/examine', [], 'fas fa-hourglass-end')
            );

        $event->addItem($menu);
    }

    protected function analize(SidebarMenuEvent $event)
    {
        $menu = new MenuItemModel('analyze', 'Analize', '/analyze', [], 'fas fa-industry');

        $menu
            ->addChild(
                new MenuItemModel('herbsId', 'Plan', '/herbs', [], 'fas fa-hourglass-start')
            )
            ->addChild(
                new MenuItemModel('herbsListId', 'Herbs', '/herbs/list', [], 'fas fa-hourglass-end')
            )
            ->addChild(
                new MenuItemModel('examineId', 'Done', '/herbs/examine', [], 'fas fa-hourglass-end')
            );

        $event->addItem($menu);
    }
}
