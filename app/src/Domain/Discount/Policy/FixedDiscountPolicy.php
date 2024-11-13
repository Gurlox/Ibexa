<?php

declare(strict_types=1);

namespace App\Domain\Discount\Policy;

use App\Domain\Price\PriceInterface;

class FixedDiscountPolicy implements DiscountPolicyInterface
{
    public function __construct(
        private readonly int $discountAmount
    ) {
    }

    public function apply(PriceInterface $price): PriceInterface
    {
         $price->applyFixedDiscount($this->discountAmount);

         return $price;
    }
}
