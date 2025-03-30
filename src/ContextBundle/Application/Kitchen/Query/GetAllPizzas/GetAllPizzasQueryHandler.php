<?php

declare(strict_types=1);

namespace App\ContextBundle\Application\Kitchen\Query\GetAllPizzas;

use App\ContextBundle\Domain\Kitchen\Repository\PizzaRepositoryInterface;

class GetAllPizzasQueryHandler
{
    private PizzaRepositoryInterface $pizzaRepository;

    public function __construct(PizzaRepositoryInterface $pizzaRepository)
    {
        $this->pizzaRepository = $pizzaRepository;
    }

    public function ask(GetAllPizzasQuery $query): array
    {
        return $this->pizzaRepository->findAll();
    }
}