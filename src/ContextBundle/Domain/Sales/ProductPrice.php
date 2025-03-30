<?php

declare (strict_types=1);

namespace App\ContextBundle\Domain\Sales;

use App\ContextBundle\Domain\Sales\ValueObjects\Price;

class ProductPrice
{
    private string $productId;
    private Price $price;

    public function __construct(string $productId, Price $price)
    {
        $this->productId = $productId;
        $this->price = $price;
    }

    public function getProductId(): string
    {
        return $this->productId;
    }

    public function getPrice(): Price
    {
        return $this->price;
    }

    public function updatePrice(Price $newPrice): void
    {
        $this->price = $newPrice;
    }
}