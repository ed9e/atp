<?php


namespace App\Service\Atp\MicroPhase;


use Symfony\Component\HttpFoundation\RequestStack;

class MicroPhase
{
    protected $description = 'Najkrótszy cykl treningowy charakteryzujący się dynamiką obciążeń występujących w ciągu 5 do 9 dni (najczęściej tydzień)';
    protected $microPhaseLength = 7;//na początek zakładamy, że tydzień

    protected $timeValue;
    /** @var RequestStack $request */
    protected $request;
    /** @var float $ratio */
    protected $ratio = 1;
    protected $basis = 300;

    /**
     * @param float $ratio
     * @return MicroPhase
     */
    public function setRatio(float $ratio): MicroPhase
    {
        $this->ratio = $ratio;
        return $this;
    }

    public function __construct(RequestStack $request)
    {
        $this->request = $request;
        switch ($this->request->getCurrentRequest()->get('weeklyType')) {
            default:
            case 'time':
                $this->basis = 300;
                break;
            case 'distance':
                $this->basis = 40;
                break;
        }
    }

    /**
     * @return mixed
     */
    public function getTimeValue()
    {
        return (int)($this->basis * $this->ratio);
    }

    /**
     * @param mixed $timeValue
     * @return MicroPhase
     */
    public function setTimeValue($timeValue): MicroPhase
    {
        $this->timeValue = $timeValue;
        return $this;
    }
}