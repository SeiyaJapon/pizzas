<?php

declare (strict_types=1);

namespace App\ContextBundle\Domain\Personnel\Repository;

use App\ContextBundle\Domain\Personnel\Employee;

interface EmployeeRepositoryInterface
{
    public function save(Employee $employee): void;
    public function findById(string $id): ?Employee;
}