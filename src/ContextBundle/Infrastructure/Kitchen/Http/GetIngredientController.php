<?php

declare(strict_types=1);

namespace App\ContextBundle\Infrastructure\Kitchen\Http;

use App\SharedContext\Infrastructure\QueryBus\QueryBusInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\ContextBundle\Application\Kitchen\Query\GetIngredient\GetIngredientQuery;

class GetIngredientController extends AbstractController
{
    private QueryBusInterface $queryBus;

    public function __construct(QueryBusInterface $queryBus)
    {
        $this->queryBus = $queryBus;
    }

    public function __invoke(Request $request, string $id): JsonResponse
    {
        $ingredient = $this->queryBus->ask(new GetIngredientQuery($id));

        if (!$ingredient) {
            return new JsonResponse(['error' => 'Ingredient not found'], JsonResponse::HTTP_NOT_FOUND);
        }

        return new JsonResponse($ingredient);
    }
}