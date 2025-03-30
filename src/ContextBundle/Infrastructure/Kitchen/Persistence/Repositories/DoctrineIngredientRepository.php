<?php

declare(strict_types=1);

namespace App\ContextBundle\Infrastructure\Kitchen\Persistence\Repositories;

use App\ContextBundle\Domain\Kitchen\Ingredient;
use App\ContextBundle\Domain\Kitchen\Repository\IngredientRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\Persistence\ObjectRepository;

class DoctrineIngredientRepository extends EntityRepository implements IngredientRepositoryInterface
{
    private EntityManagerInterface $entityManager;
    private ObjectRepository $objectRepository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager, $entityManager->getClassMetadata(Ingredient::class));

        $this->entityManager = $entityManager;
        $this->objectRepository = $entityManager->getRepository(Ingredient::class);
    }

    public function save(Ingredient $ingredient): void
    {
        $this->entityManager->persist($ingredient);
        $this->entityManager->flush();
    }

    public function findById(string $id): ?Ingredient
    {
        return $this->objectRepository->find($id);
    }

    public function findAll(): array
    {
        return $this->objectRepository->findAll();
    }

    public function isAvailable(string $ingredientId): bool
    {
        $ingredient = $this->findById($ingredientId);
        return $ingredient !== null && $ingredient->getAvailableQuantity() > 0;
    }

    public function delete(string $id): void
    {
        $ingredient = $this->findById($id);
        if ($ingredient) {
            $this->entityManager->remove($ingredient);
            $this->entityManager->flush();
        }
    }
}