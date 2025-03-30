<?php

declare (strict_types=1);

namespace App\ContextBundle\Domain\RestaurantRoom;

use App\SharedContext\Domain\AggregateRoot;

class Order extends AggregateRoot
{
    private string $id;
    private string $table;
    private array $details;
    private string $status;

    public function __construct(string $id, string $table, array $details)
    {
        $this->id = $id;
        $this->table = $table;
        $this->details = $details;
        $this->status = 'pending';
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getTable(): string
    {
        return $this->table;
    }

    public function getDetails(): array
    {
        return $this->details;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function updateStatus(string $newStatus): void
    {
        $this->status = $newStatus;
    }
}
