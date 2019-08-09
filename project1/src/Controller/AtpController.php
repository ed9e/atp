<?php

namespace App\Controller;

use App\Service\Atp\ATP;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/atp")
 */
class AtpController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function index()
    {
        $atp = new ATP();
        $atp->plan([
            'from' => '2019-06-03',
            'to' => '2019-10-07',
            //'to' => '2020-10-26',
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
