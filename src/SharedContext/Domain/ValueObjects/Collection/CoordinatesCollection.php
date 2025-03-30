<?php

declare(strict_types=1);

namespace App\SharedContext\Domain\ValueObjects\Collection;

use App\ShareContext\Domain\ValueObjects\Single\Coordinates;

class CoordinatesCollection extends AbstractCollection
{
    protected function itemClass(): string
    {
        return Coordinates::class;
    }
}
