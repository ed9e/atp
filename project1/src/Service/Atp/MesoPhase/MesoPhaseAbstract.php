<?php


namespace App\Service\Atp\MesoPhase;


abstract class MesoPhaseAbstract
{
    /**
     * Ilość mikrocykli w tym cyklu
     * @var array $microPhaseCount
     */
    protected $microPhaseCount;

    public function iterationMicroPhasesCount(): int
    {
        /** pierwszą wartość, TODO: opcjonalna ilość */
        return $this->microPhaseCount[0];
    }
}