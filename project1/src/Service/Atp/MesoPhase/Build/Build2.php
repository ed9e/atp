<?php


namespace App\Service\Atp\MesoPhase\Build;


use App\Service\Atp\MicroPhase\MicroPhase;

class Build2 extends Build
{
    protected function calculateMicroPhases(int $count): array
    {
        $phases = [
            4 => [
                [
                    (new MicroPhase())->setTimeValue(285),
                    (new MicroPhase())->setTimeValue(285),
                    (new MicroPhase())->setTimeValue(285),
                    (new MicroPhase())->setTimeValue(115),
                ],
                [
                    (new MicroPhase())->setTimeValue(285),
                    (new MicroPhase())->setTimeValue(285),
                    (new MicroPhase())->setTimeValue(285),
                    (new MicroPhase())->setTimeValue(115),
                ]
            ],
            [
                (new MicroPhase())->setTimeValue(315),
                (new MicroPhase())->setTimeValue(315),
                (new MicroPhase())->setTimeValue(115),
            ],
            [
                (new MicroPhase())->setTimeValue(300),
                (new MicroPhase())->setTimeValue(300),
                (new MicroPhase())->setTimeValue(115),
            ]
        ];

        return array_reverse($phases[$count])[$this->getNumber()];
    }
}