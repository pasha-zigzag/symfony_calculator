<?php

declare(strict_types=1);

namespace App\Detector;

use App\Detector\Dto\CalculatorRequest;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\Request;

class CalculatorRequestDetector
{
    public static function detect(Request $request): CalculatorRequest
    {
        $numberOne = $request->get('number1');
        $numberTwo = $request->get('number2');
        $operation = $request->get('operation');

        if (!is_numeric($numberOne) || !is_numeric($numberTwo)) {
            throw new InvalidArgumentException('Numeric values are required');
        }

        return new CalculatorRequest(
            (float) $numberOne,
            (float) $numberTwo,
            (string) $operation
        );
    }
}
