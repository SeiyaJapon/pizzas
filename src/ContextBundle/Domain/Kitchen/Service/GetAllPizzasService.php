<?php

declare(strict_types=1);

namespace App\ContextBundle\Domain\Kitchen\Service;

use App\Domain\Kitchen\Model\Pizza;
use App\Domain\Kitchen\Repository\PizzaRepository;

class GetAllPizzasService
{
    public function __construct(
        private readonly PizzaRepository $pizzaRepository
    ) {
    }

    public function execute(): array
    {
        return $this->pizzaRepository->findAll();
    }
} 