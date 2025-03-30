<?php

declare(strict_types=1);

namespace Tests\Integration\ContextBundle\Application\Kitchen\Command\OrderPizza;

use PHPUnit\Framework\TestCase;
use App\ContextBundle\Application\Kitchen\Command\OrderPizza\OrderPizzaCommand;
use App\ContextBundle\Application\Kitchen\Command\OrderPizza\OrderPizzaCommandHandler;
use App\ContextBundle\Domain\Kitchen\Repository\PizzaRepositoryInterface;
use App\ContextBundle\Domain\RestaurantRoom\Service\CreateOrderService;
use App\ContextBundle\Domain\Kitchen\Exceptions\PizzaNotFoundException;
use App\ContextBundle\Domain\Kitchen\Pizza;
use PHPUnit\Framework\MockObject\MockObject;

class OrderPizzaCommandHandlerIntegrationTest extends TestCase
{
    private PizzaRepositoryInterface|MockObject $pizzaRepository;
    private CreateOrderService|MockObject $createOrderService;
    private OrderPizzaCommandHandler $handler;

    protected function setUp(): void
    {
        $this->pizzaRepository = $this->createMock(PizzaRepositoryInterface::class);
        $this->createOrderService = $this->createMock(CreateOrderService::class);
        $this->handler = new OrderPizzaCommandHandler($this->pizzaRepository, $this->createOrderService);
    }

    public function testHandleCreatesOrderSuccessfully()
    {
        $pizzaId = 'pizza_id';
        $quantity = 2;
        $pizza = new Pizza($pizzaId, 'Margherita', ['tomato', 'mozzarella', 'basil'], 'pending');

        $this->pizzaRepository->expects($this->once())
            ->method('findById')
            ->with($pizzaId)
            ->willReturn($pizza);

        $this->createOrderService->expects($this->once())
            ->method('execute')
            ->with($this->isInstanceOf(Order::class));

        $command = new OrderPizzaCommand($pizzaId, $quantity);

        $this->handler->handle($command);
    }

    public function testHandleThrowsExceptionWhenPizzaNotFound()
    {
        $pizzaId = 'non_existent_pizza_id';
        $quantity = 2;
        $command = new OrderPizzaCommand($pizzaId, $quantity);

        $this->pizzaRepository->expects($this->once())
            ->method('findById')
            ->with($pizzaId)
            ->willReturn(null);

        $this->expectException(PizzaNotFoundException::class);
        $this->expectExceptionMessage($pizzaId);

        $this->handler->handle($command);
    }
}