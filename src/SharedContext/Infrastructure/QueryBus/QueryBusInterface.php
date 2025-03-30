<?php

declare (strict_types=1);

namespace App\SharedContext\Infrastructure\QueryBus;

use App\SharedContext\Application\Query\QueryInterface;

interface QueryBusInterface
{
    public function ask(QueryInterface $query);
}
