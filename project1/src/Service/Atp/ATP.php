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

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    protected $groupPhases;
    protected $done;
    protected $em;

    /**
     * @return mixed
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @return mixed
     */
    public function getTo()
    {
        return $this->to;
    }

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
        $rework = new Rework($this);
        $reworked = $rework->getReworked();
        $this->atp = array_merge(['keys' => $this->getZoomKeys()], $reworked);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getGroupPhases()
    {
        return $this->groupPhases;
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