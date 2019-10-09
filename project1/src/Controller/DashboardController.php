<?php /** @noinspection PhpUnusedAliasInspection */

namespace App\Controller;

use App\Entity\WeeklyActivity;
use App\Service\GroupedData;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class DashboardController extends AbstractController
{
    /**
     * @param EntityManagerInterface $em
     * @param RequestStack $requestStack
     * @return Response
     * @Route("/dashboard")
     * @Route("/dashboard/index")
     */
    public function index(EntityManagerInterface $em, RequestStack $requestStack): Response
    {
        $weekly = new GroupedData($requestStack->getCurrentRequest(), $em);
        $data = $weekly->getWeekly();
        return $this->render('dashboard/index.html.twig', $data);
    }

    /**
     * @Route("dashboard/calendar")
     * @param EntityManagerInterface $em
     * @return JsonResponse
     */
    public function calendar(EntityManagerInterface $em): JsonResponse
    {
        $weekly = $em->getRepository(WeeklyActivity::class);
        $weeklyResult = $weekly->getWeekly2(['activityId' => [1,2], 'userDisplayName' => 'lbrzozowski']);
        return new JsonResponse($weeklyResult);
    }

    /**
     * @Route("dashboard/statistics")
     */
    public function statistics(): void
    {
    }
}
