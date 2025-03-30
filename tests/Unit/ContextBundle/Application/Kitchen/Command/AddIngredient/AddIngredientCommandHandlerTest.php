<?php

declare(strict_types=1);

namespace Tests\Unit\ContextBundle\Application\Kitchen\Command\AddIngredient;

use PHPUnit\Framework\TestCase;
use App\ContextBundle\Application\Kitchen\Command\AddIngredient\AddIngredientCommand;
use App\ContextBundle\Application\Kitchen\Command\AddIngredient\AddIngredientCommandHandler;
use App\ContextBundle\Domain\Kitchen\Repository\IngredientRepositoryInterface;
use App\ContextBundle\Domain\Kitchen\Ingredient;
use PHPUnit\Framework\MockObject\MockObject;

class AddIngredientCommandHandlerTest extends TestCase
{
    private IngredientRepositoryInterface|MockObject $ingredientRepository;
    private AddIngredientCommandHandler $handler;

    protected function setUp(): void
    {
        $this->ingredientRepository = $this->createMock(IngredientRepositoryInterface::class);
        $this->handler = new AddIngredientCommandHandler($this->ingredientRepository);
    }

    public function testHandleAddsIngredientSuccessfully()
    {
        $command = new AddIngredientCommand('Tomato', 5);

        $this->ingredientRepository->expects($this->once())
            ->method('add')
            ->with($this->isInstanceOf(Ingredient::class));

        $this->handler->handle($command);
    }

    public function testHandleThrowsExceptionWhenIngredientAlreadyExists()
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Ingredient already exists.');

        $command = new AddIngredientCommand('Tomato', 5);

        $this->ingredientRepository->method('add')
            ->willThrowException(new \RuntimeException('Ingredient already exists.'));

        $this->handler->handle($command);
    }

    public function testHandleThrowsExceptionWhenSaveFails()
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Failed to save ingredient.');

        $command = new AddIngredientCommand('Tomato', 5);

        $this->ingredientRepository->method('add')
            ->willThrowException(new \RuntimeException('Failed to save ingredient.'));

        $this->handler->handle($command);
    }
}