<?php

declare(strict_types=1);

namespace App\ContextBundle\Domain\Kitchen\Service;

use App\ContextBundle\Domain\Kitchen\Event\PizzaCreatedEvent;
use App\ContextBundle\Domain\Kitchen\Pizza;
use App\ContextBundle\Domain\Kitchen\Repository\PizzaRepositoryInterface;
use App\SharedContext\Domain\Event\DomainEventInterface;

class CreatePizzaService
{
    public function __construct(
        private readonly PizzaRepositoryInterface $pizzaRepository,
        private readonly DomainEventInterface $eventDispatcher
    ) {
    }

    public function execute(string $id, string $name, array $ingredients, float $price): Pizza
    {
        $pizza = new Pizza($id, $name, $ingredients);

        $this->pizzaRepository->save($pizza);

        $this->eventDispatcher->dispatch(
            new PizzaCreatedEvent($id, $price)
        );

        return $pizza;
    }
}