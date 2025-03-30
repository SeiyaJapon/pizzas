<?php

declare(strict_types=1);

namespace App\ContextBundle\Infrastructure\Kitchen\Http;

use App\SharedContext\Infrastructure\QueryBus\QueryBusInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\ContextBundle\Application\Kitchen\Query\GetPizza\GetPizzaQuery;

class GetPizzaController extends AbstractController
{
    private QueryBusInterface $queryBus;

    public function __construct(QueryBusInterface $queryBus)
    {
        $this->queryBus = $queryBus;
    }

    public function __invoke(Request $request, string $id): JsonResponse
    {
        $pizza = $this->queryBus->ask(new GetPizzaQuery($id));

        if (!$pizza) {
            return new JsonResponse(['error' => 'Pizza not found'], JsonResponse::HTTP_NOT_FOUND);
        }

        return new JsonResponse($pizza);
    }
}