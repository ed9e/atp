<?php


namespace App\Service\Atp\MicroPhase;


class MicroPhase
{
    protected $description = 'Najkrótszy cykl treningowy charakteryzujący się dynamiką obciążeń występujących w ciągu 5 do 9 dni (najczęściej tydzień)';
    protected $microPhaseLength = 7;//na początek zakładamy, że tydzień

    protected $timeValue;
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * @return mixed
     */
    public function getTimeValue()
    {
        return $this->timeValue;
    }

    /**
     * @param mixed $timeValue
     * @return MicroPhase
     */
    public function setTimeValue($timeValue)
    {
        $this->timeValue = $timeValue;
        return $this;
    }
}