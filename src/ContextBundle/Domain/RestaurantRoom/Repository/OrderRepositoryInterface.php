<?php

declare (strict_types=1);

namespace App\ContextBundle\Domain\RestaurantRoom\Repository;

use App\ContextBundle\Domain\RestaurantRoom\Order;

interface OrderRepositoryInterface
{
    public function save(Order $order): void;
    public function findById(string $id): ?Order;
    public function findAll(): array;
    public function findByStatus(string $status): array;
    public function delete(string $id): void;
    public function processOrder(string $orderId): void;
}