<?php

declare (strict_types = 1);

namespace App\SharedContext\Application\Query;

interface QueryResultInterface
{
    public function result(): array;
}
