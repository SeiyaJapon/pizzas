<?php

declare(strict_types=1);

namespace App\ContextBundle\Domain\Kitchen\Service;

use App\ContextBundle\Domain\Kitchen\Repository\IngredientRepositoryInterface;

class ValidateIngredientsService
{
    private IngredientRepositoryInterface $ingredientRepository;

    public function __construct(IngredientRepositoryInterface $ingredientRepository)
    {
        $this->ingredientRepository = $ingredientRepository;
    }

    public function validate(array $ingredients): bool
    {
        foreach ($ingredients as $ingredient) {
            if (!$this->ingredientRepository->isAvailable($ingredient)) {
                return false;
            }
        }

        return true;
    }
}