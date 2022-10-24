<?php

declare(strict_types=1);

namespace App\Controller;

use App\Command\Account\AccountCommand;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\DelayStamp;
use Symfony\Component\Routing\Annotation\Route;

class ApiController
{
    public function __construct(
        private MessageBusInterface $commandBus
    ) {
    }

    #[Route('/account/{id}', name: 'account', methods: ['GET'])]
    public function actionAccount(int $id): Response
    {
        if ($id % 2 === 0) {
            $this->commandBus->dispatch(new AccountCommand($id), [new DelayStamp(100)]);
        } else {
            $this->commandBus->dispatch(new AccountCommand($id));
        }

        return new JsonResponse(['message' => 'ok']);
    }
}
