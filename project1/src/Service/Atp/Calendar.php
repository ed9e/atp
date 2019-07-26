<?php


namespace App\Service\Atp;


class Calendar
{
    protected $weeks;
    protected $countWeeks;

    public function __construct($weeks)
    {
        $this->weeks = $weeks;
        $this->countWeeks = count($weeks);
        dump($this->countWeeks);
    }

    public function setExoPhase($count, $exoPhaseName)
    {
        while ($count > 0) {
            $count--;
            next($this->weeks);
        }
    }

    /**
     * @return int
     */
    public function getCountWeeks(): int
    {
        return $this->countWeeks;
    }

    public function valid($sub)
    {
        return $this->countWeeks >= $sub;
    }

    public function sub(int $sub): void
    {
        $this->countWeeks -= $sub;
    }

}