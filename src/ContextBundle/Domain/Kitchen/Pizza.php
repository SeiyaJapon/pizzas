<?php

declare(strict_types=1);

namespace App\ContextBundle\Domain\Kitchen;

use App\SharedContext\Domain\AggregateRoot;

class Pizza extends AggregateRoot
{
    private string $id;
    private string $name;
    private array $ingredients;
    private string $status;

    public function __construct(string $id, string $name, array $ingredients = [], string $status = 'pending')
    {
        $this->id = $id;
        $this->name = $name;
        $this->ingredients = $ingredients;
        $this->status = $status;
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

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function setName(string $name): void
    {
        if (empty($name)) {
            throw new \InvalidArgumentException('The name cannot be empty.');
        }
        $this->name = $name;
    }

    public function setIngredient(string $ingredient): void
    {
        if (!in_array($ingredient, $this->ingredients)) {
            $this->ingredients[] = $ingredient;
        }
    }

    public function removeIngredient(string $ingredient): void
    {
        $this->ingredients = array_filter($this->ingredients, function ($existingIngredient) use ($ingredient) {
            return $existingIngredient !== $ingredient;
        });
    }

    public function hasIngredient(string $ingredient): bool
    {
        return in_array($ingredient, $this->ingredients);
    }

    public function setIngredients(array $ingredients): void
    {
        $this->ingredients = $ingredients;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }
}