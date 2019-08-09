<?php

namespace App\Controller;

use App\Service\Atp\ATP;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
        $atp = new ATP();
        $atp->plan([
            'from' => '2019-07-08',
            'to' => '2020-05-11',
        ])->fetchPlan()->rework();

        return $this->render('atp/index.html.twig', $atp->getAtp());
    }

    /**
     * @Route("/current")
     */
    public function current()
    {
        $atp = new ATP();
        $atp->plan([
            'from' => '2020-08-09',
            'to' => '2021-07-04'
        ])->fetchData()->rework();


        return $this->render('atp/index.html.twig', $atp->getAtp());
    }
}
