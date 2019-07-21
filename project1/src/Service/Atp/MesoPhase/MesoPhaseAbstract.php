<?php


namespace App\Service\Atp\MesoPhase;


abstract class MesoPhaseAbstract
{
    /**
     * Ilość mikrocykli w tym cyklu
     * @var array $microPhaseCount
     */
    protected $microPhaseCount;


    /**
     * @return array
     */
    public function getMicroPhaseCount(): array
    {
        return $this->microPhaseCount;
    }
}