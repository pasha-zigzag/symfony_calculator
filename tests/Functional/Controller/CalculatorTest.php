<?php

declare(strict_types=1);

namespace App\Tests\Functional\Controller;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;

class CalculatorTest extends WebTestCase
{
    private KernelBrowser $client;

    public function setUp(): void
    {
        $this->client = self::createClient();
    }

    public function testSuccessResponse(): void
    {
        $this->client->request(Request::METHOD_GET, '/');

        self::assertResponseIsSuccessful();
        self::assertPageTitleSame('Calculator!');
    }

    /** @dataProvider successDataProvider */
    public function testSuccessCalculateResult(float $numberOne, float $numberTwo, string $operation, float $result): void
    {
        $this->client->request(Request::METHOD_POST, '/', [
            'number1' => $numberOne,
            'number2' => $numberTwo,
            'operation' => $operation,
        ]);

        self::assertSelectorTextSame('.result', "{$numberOne} {$operation} {$numberTwo} equals {$result}");
    }

    /** @dataProvider errorDataProvider */
    public function testErrorCalculateResult($numberOne, $numberTwo, string $operation, string $error): void
    {
        $this->client->request(Request::METHOD_POST, '/', [
            'number1' => $numberOne,
            'number2' => $numberTwo,
            'operation' => $operation,
        ]);

        self::assertSelectorTextSame('.error', $error);
    }

    public function successDataProvider(): \Generator
    {
        yield [3, 2, 'plus', 5];
        yield [-100, 23, 'plus', -77];
        yield [30.4, 0, 'plus', 30.4];

        yield [14.6, 3.2, 'minus', 11.4];
        yield [50, 60, 'minus', -10];
        yield [33, 33, 'minus', 0];

        yield [3.5, 2, 'times', 7];
        yield [0, 7, 'times', 0];
        yield [40, -4, 'times', -160];

        yield [15, 5, 'divided by', 3];
        yield [5, -10, 'divided by', -0.5];
    }

    public function errorDataProvider(): \Generator
    {
        yield [5, 0, 'divided by', 'Division by zero error'];
        yield [5, 0, 'sum', 'Invalid operator name'];
        yield ['qwerty', 'asd', 'plus', 'Numeric values are required'];
    }
}
