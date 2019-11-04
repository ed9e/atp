<?php

namespace App\Service;

use App\Entity\WeeklyActivity;
use App\Repository\WeeklyRepository;
use App\Service\Atp\Plan;
use DateInterval;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class CurrentDashboardService
{
    protected $request;
    protected $em;

    public function __construct(Request $request, EntityManagerInterface $em)
    {
        $this->request = $request;
        $this->em = $em;
    }


    public function getWeekly()
    {
        $queryParams = $this->prepareWeeklyQueryParams($this->request);
        $options = [
            'from' => (new DateTime())->setTimestamp(strtotime('next friday'))->sub(new DateInterval('P330W')),
            'to' => (new DateTime())->setTimestamp(strtotime('next friday')),
        ];

        $keys = Plan::createIntervalArray($options['from'], clone ($options['to'])->add(new DateInterval('P20W')));

        /** @var WeeklyRepository $weekly */
        $weekly = $this->em->getRepository(WeeklyActivity::class);

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

        //$values = array_fill_keys($plan->createIntervalArrayBy((new DateTime())->setTimestamp(strtotime('previous friday')), 'P20W'), 0);
        $values = [];
        $zoomMin = $this->getZoomStartDate();

        return ['zoomMin' => $zoomMin, 'keys' => $keys, 'done' => $done, 'values' => $values, 'phases' => NotesService::getNotes()];
    }

    protected function prepareWeeklyQueryParams(Request $request): array
    {
        $activity_id = array_filter(explode(',', $request->query->get('activityId')));
        $activity_id = count($activity_id) > 0 ? $activity_id : [1, 6];
        $userDisplayName = $request->query->get('profileId') ?: 'lbrzozowski';
        $weeklyType = $request->query->get('weeklyType') ?: 'time';


        return ['activityId' => $activity_id, 'userDisplayName' => $userDisplayName, 'weeklyType' => $weeklyType];
    }

    protected function getZoomStartDate()
    {
        return (new DateTime())->setTimestamp(strtotime('next friday'))->sub(new DateInterval('P130W'))->format('Y-m-d');
    }
}