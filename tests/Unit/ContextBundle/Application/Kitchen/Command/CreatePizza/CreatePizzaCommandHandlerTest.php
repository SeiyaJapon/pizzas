<?php

declare(strict_types=1);

namespace Tests\Unit\ContextBundle\Application\Kitchen\Command\CreatePizza;

use PHPUnit\Framework\TestCase;
use App\ContextBundle\Application\Kitchen\Command\CreatePizza\CreatePizzaCommand;
use App\ContextBundle\Application\Kitchen\Command\CreatePizza\CreatePizzaCommandHandler;
use App\ContextBundle\Domain\Kitchen\Service\CreatePizzaService;
use PHPUnit\Framework\MockObject\MockObject;
use Ramsey\Uuid\Uuid;

class CreatePizzaCommandHandlerTest extends TestCase
{
    private CreatePizzaService|MockObject $createPizzaService;
    private CreatePizzaCommandHandler $handler;

    protected function setUp(): void
    {
        $this->createPizzaService = $this->createMock(CreatePizzaService::class);
        $this->handler = new CreatePizzaCommandHandler($this->createPizzaService);
    }

    public function testHandleCreatesPizzaSuccessfully()
    {
        $id = Uuid::uuid4()->toString();
        $command = new CreatePizzaCommand($id, 'Margherita', ['tomato', 'mozzarella', 'basil'], 'pending', 10.0);

        $this->createPizzaService->expects($this->once())
            ->method('execute')
            ->with(
                $this->equalTo($id),
                $this->equalTo('Margherita'),
                $this->equalTo(['tomato', 'mozzarella', 'basil']),
                $this->equalTo(10.0)
            );

        $this->handler->handle($command);
    }

    public function testHandleThrowsExceptionWhenPizzaAlreadyExists()
    {
        $id = Uuid::uuid4()->toString();
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Pizza already exists.');

        $command = new CreatePizzaCommand($id, 'Margherita', ['tomato', 'mozzarella', 'basil'], 'pending', 10.0);

        $this->createPizzaService->method('execute')
            ->willThrowException(new \RuntimeException('Pizza already exists.'));

        $this->handler->handle($command);
    }

    public function testHandleThrowsExceptionWhenSaveFails()
    {
        $id = Uuid::uuid4()->toString();
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Failed to save pizza.');

        $command = new CreatePizzaCommand($id, 'Margherita', ['tomato', 'mozzarella', 'basil'], 'pending', 10.0);

        $this->createPizzaService->method('execute')
            ->willThrowException(new \RuntimeException('Failed to save pizza.'));

        $this->handler->handle($command);
    }
}