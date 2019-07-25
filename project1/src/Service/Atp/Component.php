<?php


namespace App\Service\Atp;


use App\Service\Atp\ExoPhase\Base\Base1;
use App\Service\Atp\ExoPhase\Base\Base2;
use App\Service\Atp\ExoPhase\Base\Base3;
use App\Service\Atp\ExoPhase\Build\Build1;
use App\Service\Atp\ExoPhase\Build\Build2;
use App\Service\Atp\ExoPhase\Build\Build3;
use App\Service\Atp\ExoPhase\Peak;
use App\Service\Atp\ExoPhase\PhaseIterator;
use App\Service\Atp\ExoPhase\Preparation\Preparation;
use App\Service\Atp\ExoPhase\Race;

class Component
{
    protected $phases = [];

    public function __construct(Calendar $calendar)
    {
        $this->phases[] = new Race($calendar);
        $this->phases[] = new Peak($calendar);
        $this->phases[] = new Build3($calendar);
        $this->phases[] = new Build2($calendar);
        $this->phases[] = new Build1($calendar);
        $this->phases[] = new Base3($calendar);
        $this->phases[] = new Base2($calendar);
        $this->phases[] = new Base1($calendar);
        $this->phases[] = new Preparation($calendar);
    }

    /**
     * @return array
     */
    public function getPhases(): array
    {
        return $this->phases;
    }

    public function showTaken()
    {
        foreach (new PhaseIterator($this->phases) as $phase) {
            dump(get_class($phase) . ' ' . $phase->getPlaceTaker()->getTaken());
        }
    }
}