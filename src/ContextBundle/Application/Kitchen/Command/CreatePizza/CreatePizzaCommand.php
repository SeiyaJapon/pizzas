<?php

declare(strict_types=1);

namespace App\ContextBundle\Application\Kitchen\Command\CreatePizza;

use App\SharedContext\Application\Command\CommandInterface;

class CreatePizzaCommand implements CommandInterface
{
    private string $id;
    private string $name;
    private array $ingredients;
    private string $status;
    private float $price;

    public function __construct(string $id, string $name, array $ingredients, string $status, float $price)
    {
        $this->id = $id;
        $this->name = $name;
        $this->ingredients = $ingredients;
        $this->status = $status;
        $this->price = $price;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getIngredients(): array
    {
        return $this->ingredients;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getPrice(): float
    {
        return $this->price;
    }
}