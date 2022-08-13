<?php

declare(strict_types=1);

namespace Unit\Service;

use App\Enum\OperatorEnum;
use App\Service\CalculatorService;
use PHPUnit\Framework\TestCase;

class CalculatorServiceTest extends TestCase
{
    /** @dataProvider dataProvider */
    public function testCalculator(float $numberOne, float $numberTwo, OperatorEnum $operator, float $result): void
    {
        $calculator = new CalculatorService();
        self::assertEquals($calculator->execute($numberOne, $numberTwo, $operator), $result);
    }

    public function testDivisionByZeroError(): void
    {
        $calculator = new CalculatorService();
        $this->expectException(\DivisionByZeroError::class);
        $calculator->execute(5, 0, OperatorEnum::DIVIDED_BY);
    }

    public function dataProvider(): \Generator
    {
        yield [3, 2, OperatorEnum::PLUS, 5];
        yield [-100, 23, OperatorEnum::PLUS, -77];
        yield [30.4, 0, OperatorEnum::PLUS, 30.4];

        yield [14.6, 3.2, OperatorEnum::MINUS, 11.4];
        yield [50, 60, OperatorEnum::MINUS, -10];
        yield [33, 33, OperatorEnum::MINUS, 0];

        yield [3.5, 2, OperatorEnum::TIMES, 7];
        yield [0, 7, OperatorEnum::TIMES, 0];
        yield [40, -4, OperatorEnum::TIMES, -160];

        yield [15, 5, OperatorEnum::DIVIDED_BY, 3];
        yield [5, -10, OperatorEnum::DIVIDED_BY, -0.5];
    }
}
