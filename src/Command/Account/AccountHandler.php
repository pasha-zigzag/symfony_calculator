<?php

declare(strict_types=1);

namespace App\Command\Account;

class AccountHandler
{
    public function __invoke(AccountCommand $command): void
    {
        sleep(1);
    }
}
