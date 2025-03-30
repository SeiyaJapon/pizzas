<?php

declare(strict_types=1);

namespace App\ContextBundle\Domain\Kitchen\Repository;

use App\ContextBundle\Domain\Kitchen\Pizza;

interface PizzaRepositoryInterface
{
    public function save(Pizza $pizza): void;
    public function findById(string $id): ?Pizza;
    public function findAll(): array;
    public function findByStatus(string $status): array;
    public function delete(string $id): void;
}