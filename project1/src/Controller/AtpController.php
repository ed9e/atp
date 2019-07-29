<?php

namespace App\Controller;

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
        $posts = 'ASDF';

        return $this->render(
            'atp/index.html.twig',
            ['articles' => $posts]
        );
    }
}
