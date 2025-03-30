<?php

declare(strict_types=1);

namespace App\ContextBundle\Application\Kitchen\Command\AddIngredient;

use App\ContextBundle\Domain\Kitchen\Repository\IngredientRepositoryInterface;

class AddIngredientCommandHandler
{
    private IngredientRepositoryInterface $ingredientRepository;

    public function __construct(IngredientRepositoryInterface $ingredientRepository)
    {
        $this->ingredientRepository = $ingredientRepository;
    }

    public function handle(AddIngredientCommand $command): void
    {
        $ingredient = new Ingredient($command->getName(), $command->getQuantity());
        $this->ingredientRepository->add($ingredient);
    }
}