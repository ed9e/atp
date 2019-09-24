<?php


namespace App\Controller;

use App\Entity\GarminActivityDetails;
use App\Entity\WeeklyActivity;
use App\Repository\ActivityDetailsRepository;
use App\Repository\WeeklyRepository;
use App\Service\Atp\Plan;
use Doctrine\ORM\EntityManager;
use DateTime;
use DateInterval;
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
     * @return JsonResponse
     */
    public function weekly(Request $request, EntityManagerInterface $em)
    {
        $queryParams = $this->prepareWeeklyQueryParams($request);

        $options = [
            'from' => (new DateTime())->setTimestamp(strtotime('next monday'))->sub(new DateInterval('P120W')),
            'to' => (new DateTime())->setTimestamp(strtotime('next monday')),
        ];
        $plan = new Plan($options);
        $keys = $plan->createIntervalArray($options['from'], clone ($options['to'])->add(new DateInterval('P20W')));

        /** @var WeeklyRepository $weekly */
        $weekly = $em->getRepository(WeeklyActivity::class);

        $weeklyResult = $weekly->getWeekly2($queryParams);
        switch ($queryParams['weeklyType']) {
            default:
            case 'time':
                $weeklyData = array_column($weeklyResult, 'timeMinuteSum', 'weekly');
                break;
            case 'distance':
                $weeklyData = array_column($weeklyResult, 'distanceSum', 'weekly');
                break;
        }


        $diff = array_diff($keys, array_keys($weeklyData));
        $done = array_merge(array_fill_keys($diff, 0), $weeklyData);
        ksort($done);

        $values = array_fill_keys($plan->createIntervalArrayBy((new DateTime())->setTimestamp(strtotime('previous monday')), 'P20W'), 0);

        return $this->json(['data' => ['keys' => $keys, 'done' => $done, 'values' => $values]]);
    }

    protected function prepareWeeklyQueryParams(Request $request)
    {
        $activity_id = array_filter(explode(',', $request->query->get('activityId')));
        $userDisplayName = $request->query->get('profileId');
        $weeklyType = $request->query->get('weeklyType');
        return ['activityId' => $activity_id, 'userDisplayName' => $userDisplayName, 'weeklyType' => $weeklyType];
    }
}