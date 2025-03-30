<?php

declare(strict_types=1);

namespace App\SharedContext\Infrastructure\Events;

use App\SharedContext\Domain\Event\DomainEventInterface;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

class DomainEventDispatcher implements DomainEventInterface
{
    private EventDispatcherInterface $eventDispatcher;

    public function __construct(EventDispatcherInterface $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
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