<?php


namespace App\Service\Atp\ExoPhase;


use App\Service\Atp\MesoPhase\MesoPhaseAbstract;

abstract class PhaseAbstract
{
    protected $description = 'Mezocykl, cykl treningowy średniej długości, wchodzący w skład rocznego cyklu (makrocyklu) charakteryzujący dynamikę obciążeń i charakter pracy w okresie około 4 tygodni';
    protected $percentOfWeeklyAvgHours;
    protected $cyclesCount;
    protected $cycleLength;

    /** @var MesoPhaseAbstract */
    protected $mesoPhase;
    /** @var integer */
    protected $mesoPhaseCount;



    abstract public function getPercentOfWeeklyAvgHours(): float;
}