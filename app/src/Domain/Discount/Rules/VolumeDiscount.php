<?php

declare(strict_types=1);

namespace App\Domain\Discount\Rules;

use App\Domain\Discount\Policy\FixedDiscountPolicy;
use App\Domain\Discount\Specification\ProductsCollectionSpecification\ProductsCollectionQuantitySpecification;

class VolumeDiscount implements ProductsCollectionDiscountRuleInterface
{
    public function getPolicies(): array
    {
        return [
            new FixedDiscountPolicy(100),
        ];
    }

    public function getSpecifications(): array
    {
        return [
            new ProductsCollectionQuantitySpecification(10),
        ];
    }
}
