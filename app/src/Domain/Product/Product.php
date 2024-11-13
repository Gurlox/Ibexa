<?php

declare(strict_types=1);

namespace App\Domain\Product;

use App\Domain\Exception\ValidationException;
use App\Domain\Price\PriceInterface;

class Product implements ProductInterface
{
    private int $quantity;

    public function __construct(
        private readonly ProductCode $code,
        private PriceInterface $price,
        int $quantity,
    ) {
        if ($quantity < 1) {
            throw new ValidationException('Quantity of product must be at least 1');
        }

        $this->quantity = $quantity;
    }

    public function getCode(): ProductCode
    {
        return $this->code;
    }

    public function getPrice(): PriceInterface
    {
        return $this->price;
    }

    public function getTotalPrice(): PriceInterface
    {
        $price = clone $this->price;

        return $price->multiply($this->quantity);
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }
}
