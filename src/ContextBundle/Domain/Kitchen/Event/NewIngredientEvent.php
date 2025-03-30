<?php

declare(strict_types=1);

namespace App\ContextBundle\Domain\Kitchen\Event;

use App\SharedContext\Domain\Event\DomainEventInterface;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

class NewIngredientEvent implements DomainEventInterface
{
    private string $ingredientId;
    private \DateTimeImmutable $occurredOn;
    private EventDispatcherInterface $eventDispatcher;

    public function __construct(string $ingredientId, EventDispatcherInterface $eventDispatcher)
    {
        $this->ingredientId = $ingredientId;
        $this->occurredOn = new \DateTimeImmutable();
        $this->eventDispatcher = $eventDispatcher;
    }

    public function getIngredientId(): string
    {
        return $this->ingredientId;
    }

    public function getOccurredOn(): \DateTimeImmutable
    {
        return $this->occurredOn;
    }

    public function dispatch($event): void
    {
        $this->eventDispatcher->dispatch($event);
    }
}