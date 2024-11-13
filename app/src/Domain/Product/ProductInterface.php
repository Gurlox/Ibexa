<?php

declare(strict_types=1);

namespace App\Domain\Product;

use App\Domain\Price\PriceInterface;

interface ProductInterface
{
    public function getCode(): ProductCode;

    public function getPrice(): PriceInterface;

    public function getTotalPrice(): PriceInterface;

    public function getQuantity(): int;
}
