<?php

namespace App\Controller;


use App\Service\GarminManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GarminCalendarController extends AbstractController
{
    /**
     * @Route("/garmin/calendar", name="garmin_calendar")
     * @param GarminManager $manager
     * @return Response
     */
    public function index(GarminManager $manager): Response
    {

        $manager->importCalendar();

        return new Response('co...co się stało?');
    }
}
