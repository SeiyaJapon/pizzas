<?php

declare(strict_types=1);

namespace App\ContextBundle\Domain\Kitchen\Service;

use App\ContextBundle\Domain\Kitchen\Repository\IngredientRepositoryInterface;

class UpdateInventoryService
{
    private IngredientRepositoryInterface $ingredientRepository;

    public function __construct(IngredientRepositoryInterface $ingredientRepository)
    {
        $this->ingredientRepository = $ingredientRepository;
    }

    public function updateInventory(string $ingredientId, int $quantity): void
    {
        $ingredient = $this->ingredientRepository->findById($ingredientId);
        if ($ingredient === null) {
            throw new \InvalidArgumentException("Ingredient with ID $ingredientId not found.");
        }

        if ($quantity < 0) {
            $ingredient->reduceQuantity(abs($quantity));
        } else {
            $ingredient->increaseQuantity($quantity);
        }

        $this->ingredientRepository->save($ingredient);
    }
}