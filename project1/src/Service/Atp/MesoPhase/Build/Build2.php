<?php


namespace App\Service\Atp\MesoPhase\Build;


class Build2 extends Build
{
    protected function calculateMicroPhases(int $count): array
    {
        $phases = [
            4 => [
                [
                    (clone $this->microPhaseTmp)->setTimeValue(285)->setRatio(0.95),
                    (clone $this->microPhaseTmp)->setTimeValue(285)->setRatio(0.95),
                    (clone $this->microPhaseTmp)->setTimeValue(285)->setRatio(0.95),
                    (clone $this->microPhaseTmp)->setTimeValue(115)->setRatio(0.38333),
                ],
                [
                    (clone $this->microPhaseTmp)->setTimeValue(285)->setRatio(0.95),
                    (clone $this->microPhaseTmp)->setTimeValue(285)->setRatio(0.95),
                    (clone $this->microPhaseTmp)->setTimeValue(285)->setRatio(0.95),
                    (clone $this->microPhaseTmp)->setTimeValue(115)->setRatio(0.38333),
                ]
            ],
            [
                (clone $this->microPhaseTmp)->setTimeValue(315)->setRatio(1.05),
                (clone $this->microPhaseTmp)->setTimeValue(315)->setRatio(1.05),
                (clone $this->microPhaseTmp)->setTimeValue(115)->setRatio(0.38333),
            ],
            [
                (clone $this->microPhaseTmp)->setTimeValue(300)->setRatio(1),
                (clone $this->microPhaseTmp)->setTimeValue(300)->setRatio(1),
                (clone $this->microPhaseTmp)->setTimeValue(115)->setRatio(0.38333),
            ]
        ];

        return array_reverse($phases[$count])[$this->getNumber()];
    }
}