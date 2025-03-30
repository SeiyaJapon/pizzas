<?php

declare(strict_types=1);

namespace App\ContextBundle\Domain\Kitchen\Service;

use App\ContextBundle\Domain\Kitchen\Repository\IngredientRepositoryInterface;
use App\ContextBundle\Domain\Kitchen\Service\IngredientPricingService;

class CalculatePizzaPriceService
{
    private IngredientRepositoryInterface $ingredientRepository;
    private IngredientPricingService $ingredientPricingService;

    public function __construct(
        IngredientRepositoryInterface $ingredientRepository,
        IngredientPricingService $ingredientPricingService
    ) {
        $this->ingredientRepository = $ingredientRepository;
        $this->ingredientPricingService = $ingredientPricingService;
    }

    public function calculate(array $ingredientIds): float
    {
        $totalPrice = 0.0;

        foreach ($ingredientIds as $ingredientId) {
            $ingredient = $this->ingredientRepository->findById($ingredientId);
            if ($ingredient !== null) {
                $totalPrice += $this->ingredientPricingService->getPrice($ingredient)->getAmount();
            }
        }

        return $totalPrice;
    }
}