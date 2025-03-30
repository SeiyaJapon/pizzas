<?php

declare(strict_types=1);

namespace App\ContextBundle\Infrastructure\Kitchen\Http;

use App\SharedContext\Infrastructure\CommandBus\CommandBusInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\ContextBundle\Application\Kitchen\Command\OrderPizza\OrderPizzaCommand;

class OrderPizzaController extends AbstractController
{
    private CommandBusInterface $commandBus;

    public function __construct(CommandBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function __invoke(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $this->commandBus->handle(
            new OrderPizzaCommand($data['pizzaId'], intval($data['quantity']))
        );

        return new JsonResponse(['status' => 'Pizza ordered'], JsonResponse::HTTP_CREATED);
    }
}