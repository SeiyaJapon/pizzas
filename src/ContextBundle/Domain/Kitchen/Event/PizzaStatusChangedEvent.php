<?php

declare (strict_types=1);

namespace App\ContextBundle\Domain\Kitchen\Event;

class PizzaStatusChangedEvent
{
    private string $orderId;
    private string $oldStatus;
    private string $newStatus;

    public function __construct(string $orderId, string $oldStatus, string $newStatus)
    {
        $this->orderId = $orderId;
        $this->oldStatus = $oldStatus;
        $this->newStatus = $newStatus;
    }

    public function getOrderId(): string
    {
        return $this->orderId;
    }

    public function getOldStatus(): string
    {
        return $this->oldStatus;
    }

    public function getNewStatus(): string
    {
        return $this->newStatus;
    }
}