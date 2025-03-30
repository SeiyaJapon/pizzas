<?php

declare(strict_types=1);

namespace App\ContextBundle\Application\Kitchen\Command\OrderPizza;

use App\ContextBundle\Domain\Kitchen\Exceptions\PizzaNotFoundException;
use App\ContextBundle\Domain\Kitchen\Repository\PizzaRepositoryInterface;
use App\ContextBundle\Domain\RestaurantRoom\Order;
use App\ContextBundle\Domain\RestaurantRoom\Service\CreateOrderService;

class OrderPizzaCommandHandler
{
    private PizzaRepositoryInterface $pizzaRepository;
    private CreateOrderService $createOrderService;

    public function __construct(PizzaRepositoryInterface $pizzaRepository, CreateOrderService $createOrderService)
    {
        $this->pizzaRepository = $pizzaRepository;
        $this->createOrderService = $createOrderService;
    }

    public function handle(OrderPizzaCommand $command): void
    {
        $pizza = $this->pizzaRepository->findById($command->getPizzaId());

        if (!$pizza) {
            throw new PizzaNotFoundException($command->getPizzaId());
        }

        $order = new Order(uniqid(), 'table1', [$pizza->getId() => $command->getQuantity()]);

        $this->createOrderService->execute($order);
    }
}