<?php

declare(strict_types=1);

namespace App\Entity;

class Account
{
    public function __construct(
        private int $id,
        private string $email,
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}
