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
        $data = $repository->findByStartTime($request->query->get('date') ?? '2019-08-25');
        return $this->json(['data' => $data]);
    }
}