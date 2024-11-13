<?php

declare(strict_types=1);

namespace App\Domain\Discount\Rules;

use App\Domain\Discount\Policy\PercentageDiscountPolicy;

class PercentageProductDiscount implements SingleProductDiscountRuleInterface
{
    public function getPolicies(): array
    {
        return [
            new PercentageDiscountPolicy(10),
        ];
    }

    public function getSpecifications(): array
    {
        return [];
    }
}
