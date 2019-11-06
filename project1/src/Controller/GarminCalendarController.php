<?php

namespace App\Controller;


use App\Service\GarminManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class GarminCalendarController extends AbstractController
{
    /**
     * @Route("/garmin/calendar", name="garmin_calendar")
     * @param GarminManager $manager
     * @return JsonResponse
     */
    public function index(GarminManager $manager): JsonResponse
    {

        //$manager->importCalendar();
        $headers = [
            'Access-Control-Allow-Origin' => '*',
            'Access-Control-Allow-Methods' => 'GET, POST, PATCH, PUT, DELETE, OPTIONS',
            'Access-Control-Allow-Headers' => 'Origin, Content-Type, X-Auth-Token, access-control-allow-origin',
            'Content-Type' => 'application/json; charset=UTF-8'
        ];
        return new JsonResponse([
                ['id' => 1, 'suffer' => 1]
            ]
            , 200, $headers);
    }
}
