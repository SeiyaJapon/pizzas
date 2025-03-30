<?php

declare(strict_types=1);

namespace App\ContextBundle\Domain\Kitchen\Service;

use App\Domain\Kitchen\Repository\PizzaRepository;

class DeletePizzaService
{
    public function __construct(
        private readonly PizzaRepository $pizzaRepository
    ) {
    }

    public function execute(string $id): void
    {
        $this->pizzaRepository->delete($id);
    }
} 