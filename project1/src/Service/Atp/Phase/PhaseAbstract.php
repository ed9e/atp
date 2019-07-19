<?php


namespace App\Service\Atp\Phase;


abstract class PhaseAbstract
{
    protected $description = 'Mezocykl, cykl treningowy średniej długości, wchodzący w skład rocznego cyklu (makrocyklu) charakteryzujący dynamikę obciążeń i charakter pracy w okresie około 4 tygodni';
    protected $percentOfWeeklyAvgHours;
    protected $cyclesCount;
    protected $cycleLength;

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return PhaseAbstract
     */
    public function setDescription(string $description): PhaseAbstract
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCycleLength()
    {
        return $this->cycleLength;
    }

    /**
     * @param mixed $cycleLength
     * @return PhaseAbstract
     */
    public function setCycleLength($cycleLength)
    {
        $this->cycleLength = $cycleLength;
        return $this;
    }

    public function getCyclesCount()
    {
        return $this->cyclesCount;
    }

    abstract public function getPercentOfWeeklyAvgHours(): float;
}