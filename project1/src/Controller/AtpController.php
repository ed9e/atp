<?php

namespace App\Controller;

use App\Service\Atp\Plan;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/atp")
 * @Cache(expires="tomorrow")
 */
class AtpController extends AbstractController
{
    /**
     * @Route("/")
     * @Template
     */
    public function index()
    {
        $plan = new Plan();

        $calendar = $plan->create([
            'from' => '2020-08-09',
            'to' => '2021-07-04',
        ]);


        return $this->render(
            'atp/index.html.twig',
            ['calendar' => $calendar]
        );
    }
}
