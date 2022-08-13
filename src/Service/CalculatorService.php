<?php

declare(strict_types=1);

namespace App\Service;

use App\Enum\OperatorEnum;

class CalculatorService
{
    public function execute(float $numberOne, float $numberTwo, OperatorEnum $operator): float
    {
        return match ($operator) {
            OperatorEnum::PLUS => $this->getPlusResult($numberOne, $numberTwo),
            OperatorEnum::MINUS => $this->getMinusResult($numberOne, $numberTwo),
            OperatorEnum::TIMES => $this->getTimesResult($numberOne, $numberTwo),
            OperatorEnum::DIVIDED_BY => $this->getDividedByResult($numberOne, $numberTwo),
        };
    }

    private function getPlusResult(float $numberOne, float $numberTwo): float
    {
        return $numberOne + $numberTwo;
    }

    private function getMinusResult(float $numberOne, float $numberTwo): float
    {
        return $numberOne - $numberTwo;
    }

    private function getTimesResult(float $numberOne, float $numberTwo): float
    {
        return $numberOne * $numberTwo;
    }

    private function getDividedByResult(float $numberOne, float $numberTwo): float
    {
        return $numberOne / $numberTwo;
    }
}
