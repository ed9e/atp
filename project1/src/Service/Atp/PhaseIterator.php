<?php


namespace App\Service\Atp;


use App\Service\Atp\ExoPhase\Base\Base1;
use App\Service\Atp\ExoPhase\Base\Base2;
use App\Service\Atp\ExoPhase\Base\Base3;
use App\Service\Atp\ExoPhase\Build\Build1;
use App\Service\Atp\ExoPhase\Build\Build2;
use App\Service\Atp\ExoPhase\Build\Build3;
use App\Service\Atp\ExoPhase\Peak;
use App\Service\Atp\ExoPhase\Preparation\Preparation;
use App\Service\Atp\ExoPhase\Race;
use App\Service\Atp\ExoPhase\Transition;

class PhaseIterator
{
    protected $phases;
    public function __construct()
    {
        $this->phases = [
            new Preparation(),
            new Base1(),
            new Base2(),
            new Base3(),
            new Build1(),
            new Build2(),
            new Build3(),
            new Peak(),
            new Race(),
            new Transition()
        ];
    }
}