<?php

declare(strict_types=1);

namespace App\ContextBundle\Infrastructure\Kitchen\Http;

use App\SharedContext\Infrastructure\CommandBus\CommandBusInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\ContextBundle\Application\Kitchen\Command\AddIngredient\AddIngredientCommand;

class AddIngredientController extends AbstractController
{
    private CommandBusInterface $commandBus;

    public function __construct(CommandBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function __invoke(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $command = new AddIngredientCommand($data['name'], $data['quantity']);
        $this->commandBus->handle($command);

        return new JsonResponse(['status' => 'Ingredient added'], JsonResponse::HTTP_CREATED);
    }
}