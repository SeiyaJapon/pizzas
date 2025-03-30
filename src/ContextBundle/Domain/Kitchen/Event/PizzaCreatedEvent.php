<?php

declare(strict_types=1);

namespace App\ContextBundle\Domain\Kitchen\Event;

use App\SharedContext\Domain\Event\DomainEventInterface;

class PizzaCreatedEvent implements DomainEventInterface
{
    private string $pizzaId;
    private \DateTimeImmutable $occurredOn;
    private float $price;

    public function __construct(string $pizzaId, float $price)
    {
        $this->pizzaId = $pizzaId;
        $this->occurredOn = new \DateTimeImmutable();
        $this->price = $price;
    }

    public function getPizzaId(): string
    {
        return $this->pizzaId;
    }

    public function getOccurredOn(): \DateTimeImmutable
    {
        return $this->occurredOn;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function dispatch($event): void
    {
        // Implement dispatch logic if needed
    }
}