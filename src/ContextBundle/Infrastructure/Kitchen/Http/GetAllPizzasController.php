<?php

declare(strict_types=1);

namespace App\ContextBundle\Infrastructure\Kitchen\Http;

use App\SharedContext\Infrastructure\QueryBus\QueryBusInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\ContextBundle\Application\Kitchen\Query\GetAllPizzas\GetAllPizzasQuery;

class GetAllPizzasController extends AbstractController
{
    private QueryBusInterface $queryBus;

    public function __construct(QueryBusInterface $queryBus)
    {
        $this->queryBus = $queryBus;
    }

    public function __invoke(Request $request): JsonResponse
    {
        $pizzas = $this->queryBus->ask(new GetAllPizzasQuery());

        return new JsonResponse($pizzas);
    }
}