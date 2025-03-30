<?php

declare(strict_types=1);

namespace App\ContextBundle\Domain\Kitchen\Service;

use App\ContextBundle\Domain\Kitchen\Recipe;
use App\ContextBundle\Domain\Kitchen\Repository\RecipeRepositoryInterface;

class RecipeManagementService
{
    private RecipeRepositoryInterface $recipeRepository;

    public function __construct(RecipeRepositoryInterface $recipeRepository)
    {
        $this->recipeRepository = $recipeRepository;
    }

    public function addRecipe(string $name, array $ingredients): void
    {
        $recipe = new Recipe($name, $ingredients);
        $this->recipeRepository->save($recipe);
    }

    public function getRecipe(string $id): ?Recipe
    {
        return $this->recipeRepository->find($id);
    }

    public function getAllRecipes(): array
    {
        return $this->recipeRepository->findAll();
    }
}