<?php

declare(strict_types=1);

namespace App\ContextBundle\Domain\Kitchen\Service;

use App\ContextBundle\Domain\Kitchen\Repository\PizzaRepositoryInterface;

class UpdatePizzaStatusService
{
    private PizzaRepositoryInterface $pizzaRepository;

    public function __construct(PizzaRepositoryInterface $pizzaRepository)
    {
        $this->pizzaRepository = $pizzaRepository;
    }

    public function updateStatus(string $pizzaId, string $status): void
    {
        $pizza = $this->pizzaRepository->findById($pizzaId);

        if (!$pizza) {
            throw new \Exception('Pizza not found');
        }

        $pizza->setStatus($status);

        $this->pizzaRepository->save($pizza);
    }
}