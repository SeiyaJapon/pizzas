<?php

declare(strict_types=1);

namespace App\SharedContext\Domain\ValueObjects\Collection;

use App\ShareContext\Domain\ValueObjects\Single\Id;

class IdCollection extends AbstractCollection
{
    protected function itemClass(): string
    {
        return Id::class;
    }
}
