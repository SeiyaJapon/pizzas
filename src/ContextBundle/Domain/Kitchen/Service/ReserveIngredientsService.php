<?php

declare(strict_types=1);

namespace App\ContextBundle\Domain\Kitchen\Service;

use App\ContextBundle\Domain\Kitchen\Repository\IngredientRepositoryInterface;

class ReserveIngredientsService
{
    private IngredientRepositoryInterface $ingredientRepository;

    public function __construct(IngredientRepositoryInterface $ingredientRepository)
    {
        $this->ingredientRepository = $ingredientRepository;
    }

    public function reserve(array $ingredientIds): void
    {
        foreach ($ingredientIds as $ingredientId) {
            $ingredient = $this->ingredientRepository->findById($ingredientId);
            if ($ingredient !== null && $ingredient->getAvailableQuantity() > 0) {
                $ingredient->reserve();
                $this->ingredientRepository->save($ingredient);
            } else {
                throw new \InvalidArgumentException("Ingredient with ID $ingredientId is not available.");
            }
        }
    }
}