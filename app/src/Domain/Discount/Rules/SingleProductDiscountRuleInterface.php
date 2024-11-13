<?php

declare(strict_types=1);

namespace App\Domain\Discount\Rules;

use App\Domain\Discount\Policy\DiscountPolicyInterface;
use App\Domain\Discount\Specification\SingleProductSpecification\SingleProductSpecificationInterface;

interface SingleProductDiscountRuleInterface extends DiscountRuleInterface
{
    /**
     * @return DiscountPolicyInterface[]
     */
    public function getPolicies(): array;

    /**
     * @return SingleProductSpecificationInterface[]
     */
    public function getSpecifications(): array;
}
