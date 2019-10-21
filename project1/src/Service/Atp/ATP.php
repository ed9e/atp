<?php


namespace App\Service\Atp;


use App\Entity\WeeklyActivity;
use DateInterval;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

class ATP
{
    /** @var Plan */
    protected $plan;
    protected $atp;
    protected $data;
    protected $groupPhases;
    protected $done;
    protected $em;
    protected $requestStack;
    protected $from;
    protected $to;

    public function __construct(EntityManagerInterface $em, RequestStack $requestStack)
    {
        $this->em = $em;
        $this->requestStack = $requestStack;
    }

    public function setData($data): ATP
    {
        $this->data = $data;
        return $this;
    }

    public function plan(array $options): ATP
    {
        $this->from = $this::fixDate($options[0]['from']);
        $this->to = $this::fixDate(end($options)['to']);

        foreach ($options as &$option) {
            $option['from'] = $this::fixDate($option['from']);
            $option['to'] = $this::fixDate($option['to']);
        }
        unset($option);
        $this->plan = new Plan($options, $this->requestStack);
        return $this;
    }

    protected static function fixDate($date): string
    {
        return (new DateTime())->setTimestamp(strtotime('next friday', strtotime($date)))->format('Y-m-d');
    }

    public function fetchPlan(): ATP
    {
        $this->data = array_reverse($this->plan->create()->fetch()->getTimeValueByWeek());
        $this->groupPhases = $this->plan->getCalendar()->getGroupedExoPhase();
        return $this;
    }

    public function getDone(): array
    {
        $queryParams = $this->prepareWeeklyQueryParams($this->requestStack->getCurrentRequest());
        $weekly = $this->em->getRepository(WeeklyActivity::class);
        $weeklyResult = $weekly->getWeekly2($queryParams);
        switch ($queryParams['weeklyType']) {
            default:
            case 'time':
                $result = array_column($weeklyResult, 'timeMinuteSum', 'weekly');
                break;
            case 'distance':
                $result = array_column($weeklyResult, 'distanceSum', 'weekly');
                break;

        }
        return $result;
    }

    protected function prepareWeeklyQueryParams(Request $request): array
    {
        $activity_id = array_filter(explode(',', $request->query->get('activityId')));
        $userDisplayName = $request->query->get('profileId');
        $weeklyType = $request->query->get('weeklyType');
        return ['activityId' => $activity_id ?: [1, 6], 'userDisplayName' => $userDisplayName ?: 'lbrzozowski', 'weeklyType' => $weeklyType ?: 'time'];
    }

    public function rework(): ATP
    {
        $keys = $this->remapKeys();
        $phases = $this->remapPhases($this->groupPhases);
        $phases2 = $this->remapPhasesLine($this->groupPhases);
        $doneValues = $this->remapDoneValues($keys);
        $atpValues = $this->remapAtpValues($keys);
        $this->atp = ['keys' => $this->getZoomKeys(), 'values' => $atpValues, 'phases' => $phases, 'phases2' => $phases2, 'done' => $doneValues];

        return $this;
    }

    protected function remapKeys(): array
    {
        $firstKey = (new DateTime())->setTimestamp(strtotime('next friday', strtotime($this->from)))->sub(new DateInterval('P250W'))->format('Y-m-d');
        $lastKey = (new DateTime())->setTimestamp(strtotime('next friday', strtotime($this->to)))->add(new DateInterval('P20W'))->format('Y-m-d');
        $keys = $this->plan::createIntervalArray($firstKey, $lastKey);
        ksort($keys);
        return $keys;
    }

    protected function remapDoneValues($keys): array
    {
        $doneKeys = array_keys($this->getDone());
        ksort($doneKeys);
        $diff = array_diff($keys, $doneKeys);
        $done = array_merge(array_fill_keys($diff, 0), $this->getDone());
        ksort($done);
        return $done;
    }

    protected function remapAtpValues($keys): array
    {
        $diff = array_diff($keys, array_keys($this->data));

        $czyAtpZaczacOdZera = false;
        if (!$czyAtpZaczacOdZera) {
            $atpValues = array_merge($this->getDone(), $this->data);
            $diff = array_diff($keys, array_keys($atpValues));
            $atpValues = array_merge(array_fill_keys($diff, 0), $atpValues);
        } else {
            $atpValues = array_merge(array_fill_keys($diff, 1), $this->data);
        }
        ksort($atpValues);
        return $atpValues;
    }

    protected function remapPhases($phases): array
    {
        $result = [];
        foreach ($phases as $phase) {
            $res = array_flip(
                array_map(static function ($x) {
                    $from = (new DateTime(end($x)))->getTimestamp();
                    $to = (new DateTime(reset($x) . '+0 days'))->getTimestamp();
                    $diff = $to - $from;
                    $halfTime = $from + floor($diff / 2);
                    return date('Y-m-d', $halfTime);
                }, $phase)
            );
            foreach ($res as $k => $re) {
                $result[$k] = $re;
            }
        }
        return $result;
    }

    protected function remapPhasesLine($phases): array
    {
        $result = [];
        foreach ($phases as $phase) {
            $res = array_map(static function ($x) {
                $from = (new DateTime(reset($x) . '-4 days'))->format('Y-m-d');
                $to = (new DateTime(end($x) . '+4 days'))->format('Y-m-d');
                return [$from, $to];
            }, $phase);
            $return[] = $res;
            foreach ($res as $k => $re) {
                sort($re);
                $result[$k][] = $re;
            }
        }
        return $return;
        return $result;
    }

    protected function getZoomKeys(): array
    {
        $keys = $this->plan::createIntervalArray($this->from, $this->to);
        $prev = $this->plan->createIntervalArrayByPrev($this->from, 'P40W');
        $last = $this->plan->createIntervalArrayBy($this->to, 'P20W');
        return array_merge($prev, $keys, $last);
    }

    /**
     * @return mixed
     */
    public function getAtp()
    {
        return $this->atp;
    }
}