<?php

declare(strict_types=1);

namespace App\ContextBundle\Infrastructure\Kitchen\Http;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\SharedContext\Infrastructure\CommandBus\CommandBusInterface;
use App\ContextBundle\Application\Kitchen\Command\CreatePizza\CreatePizzaCommand;
use Ramsey\Uuid\Uuid;

class CreatePizzaController extends AbstractController
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
            new CreatePizzaCommand(
                Uuid::uuid4()->toString(),
                $data['name'],
                $data['ingredients'],
                $data['status'],
                $data['price']
            )
        );

        return new JsonResponse(['status' => 'Pizza created'], JsonResponse::HTTP_CREATED);
    }
}