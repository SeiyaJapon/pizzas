<?php

declare(strict_types=1);

namespace App\ContextBundle\Application\Kitchen\Query\GetAllIngredients;

use App\ContextBundle\Domain\Kitchen\Repository\IngredientRepositoryInterface;

class GetAllIngredientsQueryHandler
{
    private IngredientRepositoryInterface $ingredientRepository;

    public function __construct(IngredientRepositoryInterface $ingredientRepository)
    {
        $this->ingredientRepository = $ingredientRepository;
    }

    public function handle(GetAllIngredientsQuery $query): array
    {
        return $this->ingredientRepository->findAll();
    }
}