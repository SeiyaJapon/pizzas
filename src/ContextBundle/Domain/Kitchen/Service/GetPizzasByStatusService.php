<?php

declare(strict_types=1);

namespace App\ContextBundle\Domain\Kitchen\Service;

use App\Domain\Kitchen\Model\Pizza;
use App\Domain\Kitchen\Repository\PizzaRepository;

class GetPizzasByStatusService
{
    public function __construct(
        private readonly PizzaRepository $pizzaRepository
    ) {
    }

    public function execute(string $status): array
    {
        return $this->pizzaRepository->findByStatus($status);
    }
} 