<?php

declare(strict_types=1);

namespace App\Controller;

use App\Detector\CalculatorRequestDetector;
use App\Enum\OperatorEnum;
use App\Service\CalculatorService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CalculatorController extends AbstractController
{
    public function __construct(
        private readonly CalculatorService $calculatorService
    ) {
    }

    #[Route('/', name: 'index', methods: ['GET'])]
    public function indexAction(): Response
    {
        return $this->render('calculator_form.html.twig');
    }

    #[Route('/', name: 'calculate', methods: ['POST'])]
    public function calculateAction(Request $request): Response
    {
        try {
            $calculatorRequest = CalculatorRequestDetector::detect($request);
        } catch (\InvalidArgumentException $e) {
            return $this->getErrorResponse($e->getMessage());
        }

        try {
            $operatorEnum = OperatorEnum::createFromString($calculatorRequest->operation);
        } catch (\InvalidArgumentException $e) {
            return $this->getErrorResponse($e->getMessage());
        }

        try {
            $result = $this->calculatorService->execute(
                $calculatorRequest->numberOne,
                $calculatorRequest->numberTwo,
                $operatorEnum
            );
        } catch (\DivisionByZeroError) {
            return $this->getErrorResponse('Division by zero error');
        }

        return $this->render('calculator_form.html.twig', [
            'result' => "{$calculatorRequest->numberOne} {$calculatorRequest->operation} {$calculatorRequest->numberTwo} equals {$result}"
        ]);
    }

    private function getErrorResponse(string $error): Response
    {
        return $this->render('calculator_form.html.twig', ['error' => $error]);
    }
}
