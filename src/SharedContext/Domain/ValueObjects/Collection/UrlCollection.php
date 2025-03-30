<?php

declare(strict_types=1);

namespace App\SharedContext\Domain\ValueObjects\Collection;

use App\ShareContext\Domain\ValueObjects\Single\Url;

class UrlCollection extends AbstractCollection
{
    protected function itemClass(): string
    {
        return Url::class;
    }
}
