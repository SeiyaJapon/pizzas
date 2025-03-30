<?php

declare(strict_types=1);

namespace App\SharedContext\Infrastructure\Events;

use App\SharedContext\Domain\Event\DomainEventInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class EventBus implements DomainEventInterface
{
    public function __construct(
        private readonly EventDispatcherInterface $eventDispatcher
    ) {
    }

    public function dispatch($event): void
    {
        $this->eventDispatcher->dispatch($event);
    }

    public function getOccurredOn(): \DateTimeImmutable
    {
        return new \DateTimeImmutable();
    }
}