<?php

declare(strict_types=1);

namespace App\ContextBundle\Application\Kitchen\Query\GetPizza;

use App\ContextBundle\Domain\Kitchen\Repository\PizzaRepositoryInterface;

class GetPizzaQueryHandler
{
    private PizzaRepositoryInterface $pizzaRepository;

    public function __construct(PizzaRepositoryInterface $pizzaRepository)
    {
        $this->pizzaRepository = $pizzaRepository;
    }

    public function ask(GetPizzaQuery $query)
    {
        return $this->pizzaRepository->findById($query->getId());
    }
}