<?php

declare(strict_types=1);

namespace App\SharedContext\Domain\ValueObjects\Collection;

use App\ShareContext\Domain\ValueObjects\Single\Money;

class MoneyCollection extends AbstractCollection
{
    protected function itemClass(): string
    {
        return Money::class;
    }
}
