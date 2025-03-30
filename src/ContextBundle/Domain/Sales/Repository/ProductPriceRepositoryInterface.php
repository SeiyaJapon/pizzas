<?php

declare (strict_types=1);

namespace App\ContextBundle\Domain\Sales\Repository;

use App\ContextBundle\Domain\Sales\ProductPrice;

interface ProductPriceRepositoryInterface
{
    public function save(ProductPrice $productPrice): void;
    public function findByProductId(string $productId): ?ProductPrice;
}