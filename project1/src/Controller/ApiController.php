<?php


namespace App\Controller;

use App\Entity\GarminActivityDetails;
use App\Entity\WeeklyActivity;
use App\Repository\ActivityDetailsRepository;
use App\Repository\WeeklyRepository;
use App\Service\Atp\Plan;
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

    public function weekly(Request $request, EntityManagerInterface $em)
    {
        $activity_id = array_filter(explode(',', $request->query->get('activityId')));
        $options = [
            'from' => (new DateTime())->setTimestamp(strtotime('next monday'))->sub(new DateInterval('P120W')),
            'to' => (new DateTime())->setTimestamp(strtotime('next monday')),
        ];
        $plan = new Plan($options);
        $keys = $plan->createIntervalArray($options['from'], clone ($options['to'])->add(new DateInterval('P20W')));

        /** @var WeeklyRepository $weekly */
        $weekly = $em->getRepository(WeeklyActivity::class);
        $weeklyResult = $weekly->getWeekly2(['activityId' => $activity_id, 'ownerFullName' => 'Łukasz Brzozowski']);
        $weeklyData = array_column($weeklyResult, 'distanceSum', 'weekly');
        //$weeklyData = array_column($weeklyResult, 'timeMinuteSum', 'weekly');
        $diff = array_diff($keys, array_keys($weeklyData));
        $done = array_merge(array_fill_keys($diff, 1), $weeklyData);
        ksort($done);

        $values = array_fill_keys($plan->createIntervalArrayBy((new DateTime())->setTimestamp(strtotime('previous monday')), 'P20W'), 5);

        return $this->json(['data' => ['keys' => $keys, 'done' => $done, 'values' => $values]]);
    }
}