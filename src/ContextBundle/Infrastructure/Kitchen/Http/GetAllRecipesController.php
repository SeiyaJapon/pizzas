<?php

declare(strict_types=1);

namespace App\ContextBundle\Infrastructure\Kitchen\Http;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\ContextBundle\Domain\Kitchen\Repository\RecipeRepositoryInterface;

class GetAllRecipesController extends AbstractController
{
    private RecipeRepositoryInterface $recipeRepository;

    public function __construct(RecipeRepositoryInterface $recipeRepository)
    {
        $this->recipeRepository = $recipeRepository;
    }

    public function __invoke(): JsonResponse
    {
        $recipes = $this->recipeRepository->findAll();

        return new JsonResponse($recipes);
    }
}