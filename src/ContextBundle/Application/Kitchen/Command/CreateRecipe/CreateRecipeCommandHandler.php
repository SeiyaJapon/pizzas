<?php

declare(strict_types=1);

namespace App\ContextBundle\Application\Kitchen\Command\CreateRecipe;

use App\ContextBundle\Domain\Kitchen\Recipe;
use App\ContextBundle\Domain\Kitchen\Repository\RecipeRepositoryInterface;

class CreateRecipeCommandHandler
{
    private RecipeRepositoryInterface $recipeRepository;

    public function __construct(RecipeRepositoryInterface $recipeRepository)
    {
        $this->recipeRepository = $recipeRepository;
    }

    public function handle(CreateRecipeCommand $command): void
    {
        $recipe = new Recipe($command->getName(), $command->getIngredients());

        $this->recipeRepository->save($recipe);
    }
}