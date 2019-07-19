<?php


namespace App\Service\Atp;


use App\Service\Atp\Phase\Base\Base1;
use App\Service\Atp\Phase\Base\Base2;
use App\Service\Atp\Phase\Base\Base3;
use App\Service\Atp\Phase\Build\Build1;
use App\Service\Atp\Phase\Build\Build2;
use App\Service\Atp\Phase\Build\Build3;
use App\Service\Atp\Phase\Peak;
use App\Service\Atp\Phase\Preparation\Preparation;
use App\Service\Atp\Phase\Race;
use App\Service\Atp\Phase\Transition;

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