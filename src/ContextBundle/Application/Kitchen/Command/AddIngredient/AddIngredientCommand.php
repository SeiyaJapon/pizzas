<?php

declare (strict_types=1);

namespace App\ContextBundle\Application\Kitchen\Command\AddIngredient;

use App\SharedContext\Application\Command\CommandInterface;

class AddIngredientCommand implements CommandInterface
{
    private string $name;
    private int $quantity;

    public function __construct(string $name, int $quantity)
    {
        $this->name = $name;
        $this->quantity = $quantity;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }
}