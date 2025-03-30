<?php

declare(strict_types=1);

namespace App\ContextBundle\Domain\RestaurantRoom\Service;


use App\ContextBundle\Domain\RestaurantRoom\Repository\OrderRepositoryInterface;

class DeleteOrderService
{
    public function __construct(
        private readonly OrderRepositoryInterface $orderRepository
    ) {
    }

    public function execute(string $id): void
    {
        $this->orderRepository->delete($id);
    }
} 