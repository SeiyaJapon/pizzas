<?php

declare(strict_types=1);

namespace App\ContextBundle\Application\Kitchen\Command\OrderPizza;

use App\SharedContext\Application\Command\CommandInterface;

class OrderPizzaCommand implements CommandInterface
{
    private string $pizzaId;
    private int $quantity;

    public function __construct(string $pizzaId, int $quantity)
    {
        $this->pizzaId = $pizzaId;
        $this->quantity = $quantity;
    }

    public function getPizzaId(): string
    {
        return $this->pizzaId;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }
}