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
        $plan = new Plan([
            'from' => '2020-08-09',
            'to' => '2021-07-04',
        ]);

        $calendar = $plan->create([
            'from' => '2020-08-09',
            'to' => '2021-07-04',
        ])->getCalendar();

        $keys = array_merge(array_keys($calendar), $plan->createIntervalArrayBy($plan->getEnd(), 'P10W'));
        $values = array_values($calendar);
        $diff = array_diff($keys, $values);
        $values = array_merge($values, array_fill_keys(array_keys($diff), 15));

        return $this->render(
            'atp/index.html.twig',
            [
                'keys' => $keys,
                'timeVal' => $values,
            ]
        );
    }
}
