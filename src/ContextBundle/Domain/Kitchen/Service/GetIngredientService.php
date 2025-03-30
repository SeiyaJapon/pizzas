<?php

declare(strict_types=1);

namespace App\ContextBundle\Domain\Kitchen\Service;

use App\ContextBundle\Domain\Kitchen\Repository\IngredientRepositoryInterface;

class GetIngredientService
{
    private IngredientRepositoryInterface $ingredientRepository;

    public function __construct(IngredientRepositoryInterface $ingredientRepository)
    {
        $this->ingredientRepository = $ingredientRepository;
    }

    public function execute(string $id): ?array
    {
        $ingredient = $this->ingredientRepository->findById($id);

        if (!$ingredient) {
            return null;
        }

        // Convert the ingredient entity to an array or any other format needed
        return [
            'id' => $ingredient->getId(),
            'name' => $ingredient->getName(),
            'quantity' => $ingredient->getAvailableQuantity(),
        ];
    }
}