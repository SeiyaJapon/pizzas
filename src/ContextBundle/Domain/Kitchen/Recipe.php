<?php

declare (strict_types=1);

namespace App\ContextBundle\Domain\Kitchen;

class Recipe
{
    private string $name;
    private array $ingredients;

    public function __construct(string $name, array $ingredients)
    {
        $this->name = $name;
        $this->ingredients = $ingredients;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getIngredients(): array
    {
        return $this->ingredients;
    }
}