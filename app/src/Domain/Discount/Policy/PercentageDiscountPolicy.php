<?php

declare(strict_types=1);

namespace App\Domain\Discount\Policy;

use App\Domain\Price\PriceInterface;

class PercentageDiscountPolicy implements DiscountPolicyInterface
{
    public function __construct(
        private readonly int $percentage,
    ) {
    }

    public function apply(PriceInterface $price): PriceInterface
    {
        $price->applyPercentageDiscount($this->percentage);

        return $price;
    }
}
