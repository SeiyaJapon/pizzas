<?php

declare(strict_types=1);

namespace App\ContextBundle\Domain\Kitchen\Repository;

use App\ContextBundle\Domain\Kitchen\Ingredient;

interface IngredientRepositoryInterface
{
    public function save(Ingredient $ingredient): void;
    public function findById(string $id): ?Ingredient;
    public function findAll(): array;
    public function isAvailable(string $ingredientId): bool;
    public function delete(string $id): void;
}