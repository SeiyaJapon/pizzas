<?php

declare(strict_types=1);

namespace App\ContextBundle\Infrastructure\Kitchen\Http;

use App\SharedContext\Infrastructure\QueryBus\QueryBusInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\ContextBundle\Application\Kitchen\Query\GetAllIngredients\GetAllIngredientsQuery;

class GetAllIngredientsController extends AbstractController
{
    private QueryBusInterface $queryBus;

    public function __construct(QueryBusInterface $queryBus)
    {
        $this->queryBus = $queryBus;
    }

    public function __invoke(Request $request): JsonResponse
    {
        $ingredients = $this->queryBus->ask(new GetAllIngredientsQuery());

        return new JsonResponse($ingredients);
    }
}