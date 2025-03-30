<?php

declare (strict_types=1);

namespace App\ContextBundle\Infrastructure\RestaurantRoom\Persistence\Repositories;

use App\ContextBundle\Domain\RestaurantRoom\Order;
use App\ContextBundle\Domain\RestaurantRoom\Repository\OrderRepositoryInterface;

class DoctrineOrderRepository implements OrderRepositoryInterface
{
    private array $orders = [];

    public function save(Order $order): void
    {
        $this->orders[$order->getId()] = $order;
    }

    public function findById(string $id): ?Order
    {
        return $this->orders[$id] ?? null;
    }

    public function findAll(): array
    {
        return array_values($this->orders);
    }

    public function findByStatus(string $status): array
    {
        return array_filter($this->orders, fn(Order $order) => $order->getStatus() === $status);
    }

    public function delete(string $id): void
    {
        unset($this->orders[$id]);
    }

    public function processOrder(string $orderId): void
    {
        $order = $this->findById($orderId);
        if ($order === null) {
            throw new \InvalidArgumentException("Order with ID $orderId not found.");
        }

        $order->updateStatus('processing');

        $this->save($order);
    }
}