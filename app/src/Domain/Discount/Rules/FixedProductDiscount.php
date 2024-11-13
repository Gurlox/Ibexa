<?php

declare(strict_types=1);

namespace App\Domain\Discount\Rules;

use App\Domain\Discount\Policy\FixedDiscountPolicy;
use App\Domain\Discount\Specification\SingleProductSpecification\ProductCodeSpecification;
use App\Domain\Product\ProductCode;
use App\Domain\Product\ProductCodesCollection;

class FixedProductDiscount implements SingleProductDiscountRuleInterface
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
            new ProductCodeSpecification(
                new ProductCodesCollection(
                    new ProductCode('ABC'),
                ),
            ),
        ];
    }
}
