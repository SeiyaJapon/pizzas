<?php

declare (strict_types=1);

namespace App\ContextBundle\Domain\Sales\ValueObjects;

class Price
{
    private float $amount;
    private string $currency;

    public function __construct(float $amount, string $currency = 'EUR')
    {
        if ($amount < 0) {
            throw new \InvalidArgumentException('Price amount cannot be negative.');
        }
        $this->amount = $amount;
        $this->currency = $currency;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function equals(Price $other): bool
    {
        return $this->amount === $other->getAmount() &&
               $this->currency === $other->getCurrency();
    }
}