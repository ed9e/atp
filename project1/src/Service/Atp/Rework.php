<?php


namespace App\Service\Atp;


use DateInterval;
use DateTime;

class Rework
{
    /** @var ATP */
    protected $atp;
    protected $reworked;

    /**
     * @return array
     */
    public function getReworked(): array
    {
        return $this->reworked;
    }

    public function __construct(ATP $atp)
    {
        $this->atp = $atp;
        $keys = $this->remapKeys();
        $phases = $this->remapPhases($this->atp->getGroupPhases());
        $phases2 = $this->remapPhasesLine($this->atp->getGroupPhases());
        $doneValues = $this->remapDoneValues($keys);
        $atpValues = $this->remapAtpValues($keys);
        $this->reworked = ['values' => $atpValues, 'phases' => $phases, 'phases2' => $phases2, 'done' => $doneValues];
    }

    protected function remapKeys(): array
    {
        $firstKey = (new DateTime())->setTimestamp(strtotime('next friday', strtotime($this->atp->getFrom())))->sub(new DateInterval('P330W'))->format('Y-m-d');
        $lastKey = (new DateTime())->setTimestamp(strtotime('next friday', strtotime($this->atp->getTo())))->add(new DateInterval('P20W'))->format('Y-m-d');
        $keys = Plan::createIntervalArray($firstKey, $lastKey);
        ksort($keys);
        return $keys;
    }

    protected function remapDoneValues($keys): array
    {
        $doneKeys = array_keys($this->atp->getDone());
        ksort($doneKeys);
        $diff = array_diff($keys, $doneKeys);
        $done = array_merge(array_fill_keys($diff, 0), $this->atp->getDone());
        ksort($done);
        return $done;
    }

    protected function remapAtpValues($keys): array
    {
        $diff = array_diff($keys, array_keys($this->atp->getData()));

        $czyAtpZaczacOdZera = false;
        if (!$czyAtpZaczacOdZera) {
            $atpValues = array_merge($this->atp->getDone(), $this->atp->getData());
            $diff = array_diff($keys, array_keys($atpValues));
            $atpValues = array_merge(array_fill_keys($diff, 0), $atpValues);
        } else {
            $atpValues = array_merge(array_fill_keys($diff, 1), $this->atp->getData());
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
}