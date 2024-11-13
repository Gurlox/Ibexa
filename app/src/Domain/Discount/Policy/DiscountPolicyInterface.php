<?php

declare(strict_types=1);

namespace App\Domain\Discount\Policy;

use App\Domain\Price\PriceInterface;

interface DiscountPolicyInterface
{
    public function apply(PriceInterface $price): PriceInterface;
}
