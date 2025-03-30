<?php

declare (strict_types=1);

namespace App\ContextBundle\Application\Kitchen\Command\CreatePizza;

use App\ContextBundle\Domain\Kitchen\Service\CreatePizzaService;

class CreatePizzaCommandHandler
{
    private CreatePizzaService $createPizzaService;

    public function __construct(CreatePizzaService $createPizzaService)
    {
        $this->createPizzaService = $createPizzaService;
    }

    public function handle(CreatePizzaCommand $command): void
    {
        $this->createPizzaService->execute(
            $command->getId(),
            $command->getName(),
            $command->getIngredients(),
            $command->getPrice()
        );
    }
}