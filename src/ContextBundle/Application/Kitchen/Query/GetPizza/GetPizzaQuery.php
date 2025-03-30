<?php

declare (strict_types=1);

namespace App\ContextBundle\Application\Kitchen\Query\GetPizza;

use App\SharedContext\Application\Query\QueryInterface;

class GetPizzaQuery implements QueryInterface
{
    private string $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function getId(): string
    {
        return $this->id;
    }
}