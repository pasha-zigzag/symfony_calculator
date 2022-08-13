<?php

declare(strict_types=1);

namespace App\Detector\Dto;

class CalculatorRequest
{
    public function __construct(
        public readonly float $numberOne,
        public readonly float $numberTwo,
        public readonly string $operation,
    ) {
    }
}
