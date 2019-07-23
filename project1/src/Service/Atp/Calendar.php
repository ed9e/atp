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
    }
}