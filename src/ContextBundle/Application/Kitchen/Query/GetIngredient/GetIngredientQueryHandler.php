<?php

declare(strict_types=1);

namespace App\ContextBundle\Application\Kitchen\Query\GetIngredient;

use App\ContextBundle\Domain\Kitchen\Repository\IngredientRepositoryInterface;

class GetIngredientQueryHandler
{
    private IngredientRepositoryInterface $ingredientRepository;

    public function __construct(IngredientRepositoryInterface $ingredientRepository)
    {
        $this->ingredientRepository = $ingredientRepository;
    }

    public function ask(GetIngredientQuery $query)
    {
        return $this->ingredientRepository->findById($query->getId());
    }
}