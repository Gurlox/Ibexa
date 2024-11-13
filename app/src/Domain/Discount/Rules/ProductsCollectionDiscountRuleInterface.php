<?php

declare(strict_types=1);

namespace App\Domain\Discount\Rules;

use App\Domain\Discount\Policy\DiscountPolicyInterface;
use App\Domain\Discount\Specification\ProductsCollectionSpecification\ProductsCollectionSpecificationInterface;

interface ProductsCollectionDiscountRuleInterface extends DiscountRuleInterface
{
    /**
     * @return DiscountPolicyInterface[]
     */
    public function getPolicies(): array;

    /**
     * @return ProductsCollectionSpecificationInterface[]
     */
    public function getSpecifications(): array;
}
