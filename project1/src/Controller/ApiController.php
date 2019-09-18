<?php


namespace App\Controller;

use App\Entity\GarminActivityDetails;
use App\Repository\ActivityDetailsRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
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
     */
    public function index(Request $request)
    {
        /** @var ActivityDetailsRepository $repository */
        $repository = $this->entityManager->getRepository(GarminActivityDetails::class);
        $data = $repository->findByStartTime($this->prepareQueryRequest($request));
        return $this->json(['data' => $data]);
    }

    protected function prepareQueryRequest($request): array
    {
        $data = $request->query->get('data') ?? date('Y-m-d', strtotime('-1 Monday'));
        $activityId = explode(',', $request->query->get('activityId'));
        return [
            'data' => $data,
            'activityId' => $activityId,
        ];
    }
}