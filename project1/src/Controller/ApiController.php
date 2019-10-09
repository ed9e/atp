<?php


namespace App\Controller;

use App\Entity\GarminActivityDetails;
use App\Repository\ActivityDetailsRepository;
use App\Service\GroupedData;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
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
     * @Route("/")
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
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
     */
    public function weekly(Request $request, EntityManagerInterface $em): JsonResponse
    {
        $weekly = new GroupedData($request, $em);
        $data = $weekly->getWeekly();
        return $this->json(['data' => $data]);
    }

}