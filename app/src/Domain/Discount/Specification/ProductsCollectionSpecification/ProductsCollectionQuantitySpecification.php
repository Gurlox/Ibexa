<?php

declare(strict_types=1);

namespace App\Domain\Discount\Specification\ProductsCollectionSpecification;

use App\Domain\Product\ProductsCollection;

class ProductsCollectionQuantitySpecification implements ProductsCollectionSpecificationInterface
{
    public function __construct(
        private readonly int $count,
    ) {
    }

    public function isSatisfiedBy(ProductsCollection $productsCollection): bool
    {
        return $productsCollection->countWithQuantity() >= $this->count;
    }
}
