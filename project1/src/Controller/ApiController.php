<?php


namespace App\Controller;

use App\Entity\GarminActivityDetails;
use App\Repository\ActivityDetailsRepository;
use App\Service\Atp\ATP;
use App\Service\Atp\ATPFetch;
use App\Service\AtpPlanService;
use App\Service\CurrentDashboardService;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api")
 */
class ApiController extends AbstractController
{
    protected $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * DataTable data
     * @Route("/")
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     * @IsGranted("ROLE_USER")
     */
    public function index(Request $request): JsonResponse
    {

        /** @var ActivityDetailsRepository $repository */
        $repository = $this->entityManager->getRepository(GarminActivityDetails::class);
        $data = $repository->findByStartTime($this->prepareQueryRequest($request));
        return $this->json(['data' => $data]);
    }

    protected function prepareQueryRequest($request): array
    {
        $date = $request->query->get('data');
        $data = DateTime::createFromFormat('Y-m-d', $date);
        $data = $data !== false ? $data->format('Y-m-d') : date('Y-m-d', strtotime('-2 Monday'));
        $activityId = explode(',', $request->query->get('activityId'));
        $userDisplayName = $request->query->get('profileId');
        return [
            'data' => $data,
            'activityId' => $activityId,
            'userDisplayName' => $userDisplayName
        ];
    }

    /**
     * @Route("/weekly")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return JsonResponse
     * @IsGranted("ROLE_USER")
     */
    public function weekly(Request $request, EntityManagerInterface $em): JsonResponse
    {
        $weekly = new CurrentDashboardService($request, $em);
        $data = $weekly->getWeekly();
        return $this->json(['data' => $data]);
    }


    /**
     * @Route("/atp")
     * @param RequestStack $request
     * @param ATP $atp
     * @return JsonResponse
     * @IsGranted("ROLE_USER")
     */
    public function atp(RequestStack $request, ATP $atp): JsonResponse
    {
        $service = new AtpPlanService($request, $atp);
        $plan = $service->getWeekly();
        return $this->json(['data' => $plan]);
    }

    /**
     * @Route("/atp/fetch")
     * @param RequestStack $request
     * @param ATP $atp
     * @return JsonResponse
     * @IsGranted("ROLE_USER")
     */
    public function atpFetch(RequestStack $request, ATPFetch $atp): JsonResponse
    {
        $service = new AtpPlanService($request, $atp);
        $plan = $service->getWeekly();
        return $this->json(['data' => $plan]);
    }

    /**
     * @Route("/atp-post")
     * @param RequestStack $requestStack
     */
    public function atpPost(RequestStack $requestStack)
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        return $this->json();
    }
}