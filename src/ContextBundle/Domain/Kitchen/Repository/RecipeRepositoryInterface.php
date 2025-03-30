<?php

declare (strict_types=1);

namespace App\ContextBundle\Domain\Kitchen\Repository;

use App\ContextBundle\Domain\Kitchen\Recipe;

interface RecipeRepositoryInterface
{
    public function find(string $id): ?Recipe;
    public function findAll(): array;
    public function save(Recipe $recipe): void;
}