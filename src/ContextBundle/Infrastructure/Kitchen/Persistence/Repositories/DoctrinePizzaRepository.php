<?php

declare(strict_types=1);

namespace App\ContextBundle\Infrastructure\Kitchen\Persistence\Repositories;


use App\ContextBundle\Domain\Kitchen\Pizza;
use App\ContextBundle\Domain\Kitchen\Repository\PizzaRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

class DoctrinePizzaRepository implements PizzaRepositoryInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function save(Pizza $pizza): void
    {
        $this->entityManager->persist($pizza);
        $this->entityManager->flush();
    }

    public function findById(string $id): ?Pizza
    {
        return $this->entityManager->getRepository(Pizza::class)->find($id);
    }

    public function findAll(): array
    {
        return $this->entityManager->getRepository(Pizza::class)->findAll();
    }

    public function findByStatus(string $status): array
    {
        return $this->entityManager->getRepository(Pizza::class)->findBy(['status' => $status]);
    }

    public function delete(string $id): void
    {
        $pizza = $this->findById($id);

        if ($pizza) {
            $this->entityManager->remove($pizza);
            $this->entityManager->flush();
        }
    }
} 