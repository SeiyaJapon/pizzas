<?php

declare(strict_types=1);

namespace App\SharedContext\Domain\Event;

interface DomainEventInterface
{
    public function dispatch($event);
    public function getOccurredOn(): \DateTimeImmutable;
}
