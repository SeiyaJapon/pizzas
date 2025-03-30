<?php

declare (strict_types=1);

namespace App\ContextBundle\Domain\Personnel;

use App\ShareContext\Domain\AggregateRoot;

class Employee extends AggregateRoot
{
    private string $id;
    private string $name;
    private string $role;

    public function __construct(string $id, string $name, string $role)
    {
        $this->id = $id;
        $this->name = $name;
        $this->role = $role;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getRole(): string
    {
        return $this->role;
    }
}