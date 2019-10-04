<?php


namespace App\Service\Atp\MesoPhase\Build;


class Build2 extends Build
{
    protected function calculateMicroPhases(int $count): array
    {
        $phases = [
            4 => [
                [
                    (clone $this->microPhaseTmp)->setTimeValue(285),
                    (clone $this->microPhaseTmp)->setTimeValue(285),
                    (clone $this->microPhaseTmp)->setTimeValue(285),
                    (clone $this->microPhaseTmp)->setTimeValue(115),
                ],
                [
                    (clone $this->microPhaseTmp)->setTimeValue(285),
                    (clone $this->microPhaseTmp)->setTimeValue(285),
                    (clone $this->microPhaseTmp)->setTimeValue(285),
                    (clone $this->microPhaseTmp)->setTimeValue(115),
                ]
            ],
            [
                (clone $this->microPhaseTmp)->setTimeValue(315),
                (clone $this->microPhaseTmp)->setTimeValue(315),
                (clone $this->microPhaseTmp)->setTimeValue(115),
            ],
            [
                (clone $this->microPhaseTmp)->setTimeValue(300),
                (clone $this->microPhaseTmp)->setTimeValue(300),
                (clone $this->microPhaseTmp)->setTimeValue(115),
            ]
        ];

        return array_reverse($phases[$count])[$this->getNumber()];
    }
}