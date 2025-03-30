<?php

declare(strict_types=1);

namespace App\ContextBundle\Domain\Kitchen;

use App\SharedContext\Domain\AggregateRoot;

class Ingredient extends AggregateRoot
{
    private string $id;
    private string $name;
    private int $availableQuantity;

    public function __construct(string $id, string $name, int $availableQuantity)
    {
        $this->id = $id;
        $this->name = $name;
        $this->availableQuantity = $availableQuantity;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAvailableQuantity(): int
    {
        return $this->availableQuantity;
    }

    public function reduceQuantity(int $quantity): void
    {
        if ($quantity > $this->availableQuantity) {
            throw new \InvalidArgumentException('Not enough quantity available');
        }
        $this->availableQuantity -= $quantity;
    }

    public function increaseQuantity(int $quantity): void
    {
        $this->availableQuantity += $quantity;
    }

    public function reserve(): void
    {
        if ($this->availableQuantity > 0) {
            $this->availableQuantity--;
        } else {
            throw new \RuntimeException("No available quantity to reserve.");
        }
    }
}