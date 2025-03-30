<?php

declare(strict_types=1);

namespace App\ContextBundle\Infrastructure\Kitchen\Http;

use App\SharedContext\Infrastructure\CommandBus\CommandBusInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\ContextBundle\Application\Kitchen\Command\CreateRecipe\CreateRecipeCommand;

class CreateRecipeController extends AbstractController
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
            new CreateRecipeCommand($data['name'], $data['ingredients'])
        );

        return new JsonResponse(['status' => 'Recipe created'], JsonResponse::HTTP_CREATED);
    }
}