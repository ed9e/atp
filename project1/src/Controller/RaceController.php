<?php /** @noinspection PhpUnusedAliasInspection */

namespace App\Controller;

use App\Service\NotesService;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


/**
 * @Route("/race")
 */
class RaceController extends AbstractController
{
    /**
     * @Route("/")
     * @param RequestStack $request
     * @return Response
     * @throws Exception
     * @IsGranted("ROLE_USER")
     */
    public function index(RequestStack $request): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        return $this->render('race/index.html.twig', ['competitions' => NotesService::getCompetitions()]);
    }


}
