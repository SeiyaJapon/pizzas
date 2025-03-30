<?php

declare(strict_types=1);

namespace Tests\Unit\ContextBundle\Application\Kitchen\Command\CreateRecipe;

use PHPUnit\Framework\TestCase;
use App\ContextBundle\Application\Kitchen\Command\CreateRecipe\CreateRecipeCommand;
use App\ContextBundle\Application\Kitchen\Command\CreateRecipe\CreateRecipeCommandHandler;
use App\ContextBundle\Domain\Kitchen\Repository\RecipeRepositoryInterface;
use App\ContextBundle\Domain\Kitchen\Recipe;
use PHPUnit\Framework\MockObject\MockObject;

class CreateRecipeCommandHandlerTest extends TestCase
{
    private RecipeRepositoryInterface|MockObject $recipeRepository;
    private CreateRecipeCommandHandler $handler;

    protected function setUp(): void
    {
        $this->recipeRepository = $this->createMock(RecipeRepositoryInterface::class);
        $this->handler = new CreateRecipeCommandHandler($this->recipeRepository);
    }

    public function testHandleCreatesRecipeSuccessfully()
    {
        $command = new CreateRecipeCommand('Pasta', ['tomato', 'basil', 'garlic']);

        $this->recipeRepository->expects($this->once())
            ->method('save')
            ->with($this->isInstanceOf(Recipe::class));

        $this->handler->handle($command);
    }

    public function testHandleThrowsExceptionWhenRecipeAlreadyExists()
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Recipe already exists.');

        $command = new CreateRecipeCommand('Pasta', ['tomato', 'basil', 'garlic']);

        $this->recipeRepository->method('save')
            ->willThrowException(new \RuntimeException('Recipe already exists.'));

        $this->handler->handle($command);
    }

    public function testHandleThrowsExceptionWhenSaveFails()
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Failed to save recipe.');

        $command = new CreateRecipeCommand('Pasta', ['tomato', 'basil', 'garlic']);

        $this->recipeRepository->method('save')
            ->willThrowException(new \RuntimeException('Failed to save recipe.'));

        $this->handler->handle($command);
    }
}