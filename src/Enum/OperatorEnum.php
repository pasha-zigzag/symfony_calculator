<?php

declare(strict_types=1);

namespace App\Enum;

use InvalidArgumentException;

enum OperatorEnum
{
    case PLUS;
    case MINUS;
    case TIMES;
    case DIVIDED_BY;

    public static function createFromString(string $name): OperatorEnum
    {
        return match($name)
        {
            'plus' => self::PLUS,
            'minus' => self::MINUS,
            'times' => self::TIMES,
            'divided by' => self::DIVIDED_BY,
            default => throw new InvalidArgumentException('Invalid operator name')
        };
    }
}
