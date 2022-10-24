<?php

declare(strict_types=1);

namespace App\Command\Account;

class AccountCommand
{
    public function __construct(
        private int $id
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }
}
