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
            'from' => (new DateTime())->setTimestamp(strtotime('next friday'))->sub(new DateInterval('P120W')),
            'to' => (new DateTime())->setTimestamp(strtotime('next friday')),
        ];
        $plan = new Plan($options, $this->request);
        $keys = $plan->createIntervalArray($options['from'], clone ($options['to'])->add(new DateInterval('P20W')));

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
        $done = array_merge(array_fill_keys($diff, 1), $weeklyData);
        ksort($done);

        $values = array_fill_keys($plan->createIntervalArrayBy((new DateTime())->setTimestamp(strtotime('previous friday')), 'P20W'), 0);

        $notes = [
            '2017-03-11' => '12h w Kopalni Soli',
            '2019-01-26' => 'ZMB 2019',
            '2018-01-28' => 'ZMB 2018',
            '2019-05-18' => 'UltraRoztocze 65k',
            '2019-09-02' => 'Gorzycka 5',
            '2019-09-28' => 'Chartatywna 20',
            '2019-10-12' => 'UltraMaraton 52k',

        ];
        return ['keys' => $keys, 'done' => $done, 'values' => $values, 'phases' => $notes];
    }

    protected function prepareWeeklyQueryParams(Request $request): array
    {
        $activity_id = array_filter(explode(',', $request->query->get('activityId')));
        $activity_id = count($activity_id) > 0 ? $activity_id : [1, 6];
        $userDisplayName = $request->query->get('profileId') ?: 'lbrzozowski';
        $weeklyType = $request->query->get('weeklyType') ?: 'time';


        return ['activityId' => $activity_id, 'userDisplayName' => $userDisplayName, 'weeklyType' => $weeklyType];
    }
}