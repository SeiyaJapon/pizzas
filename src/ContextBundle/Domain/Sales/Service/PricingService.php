<?php

declare (strict_types=1);

namespace App\ContextBundle\Domain\Sales\Service;

use App\ContextBundle\Domain\Sales\ProductPrice;
use App\ContextBundle\Domain\Sales\Repository\ProductPriceRepositoryInterface;
use App\ContextBundle\Domain\Sales\ValueObjects\Price;

class PricingService
{
    private ProductPriceRepositoryInterface $repository;

    public function __construct(ProductPriceRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function setPrice(string $productId, float $amount, string $currency = 'USD'): ProductPrice
    {
        $price = new Price($amount, $currency);
        $productPrice = new ProductPrice($productId, $price);

        $this->repository->save($productPrice);

        return $productPrice;
    }

    public function getPrice(string $productId): ?Price
    {
        $productPrice = $this->repository->findByProductId($productId);

        return $productPrice?->getPrice();
    }
}