<?php

declare(strict_types=1);

namespace App\ContextBundle\Domain\Kitchen\Service;

use App\ContextBundle\Domain\Kitchen\Ingredient;
use App\ContextBundle\Domain\Sales\ValueObjects\Price;

class IngredientPricingService
{
    public function getPrice(Ingredient $ingredient): Price
    {
        // Here we would implement the logic to determine the price of the ingredient
        // For example, return a fixed price or calculate based on some criteria
        return new Price(10.0); // Example fixed price
    }
}