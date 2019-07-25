<?php


namespace App\Service\Atp\MesoPhase;


abstract class MesoPhaseAbstract
{
    /**
     * Ilość mikrocykli w tym cyklu
     * @var array $microPhaseIterationConfig
     */
    protected $microPhaseIterationConfig;

    public function iterationMicroPhasesCount(): int
    {
        /** pierwszą wartość, TODO: opcjonalna ilość */
        return reset($this->microPhaseIterationConfig);
    }
}