<?php

declare(strict_types=1);

namespace App\ContextBundle\Infrastructure\Kitchen\Http;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\ContextBundle\Domain\Kitchen\Repository\RecipeRepositoryInterface;

class GetRecipeController extends AbstractController
{
    private RecipeRepositoryInterface $recipeRepository;

    public function __construct(RecipeRepositoryInterface $recipeRepository)
    {
        $this->recipeRepository = $recipeRepository;
    }

    public function __invoke(string $id): JsonResponse
    {
        $recipe = $this->recipeRepository->find($id);

        if (!$recipe) {
            return new JsonResponse(['error' => 'Recipe not found'], JsonResponse::HTTP_NOT_FOUND);
        }

        return new JsonResponse($recipe);
    }
}