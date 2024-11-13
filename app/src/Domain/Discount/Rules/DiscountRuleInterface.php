<?php

declare(strict_types=1);

namespace App\Domain\Discount\Rules;

interface DiscountRuleInterface
{
    public function getPolicies(): array;

    public function getSpecifications(): array;
}
