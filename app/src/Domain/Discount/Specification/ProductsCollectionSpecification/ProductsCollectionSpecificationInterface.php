<?php

declare(strict_types=1);

namespace App\Domain\Discount\Specification\ProductsCollectionSpecification;

use App\Domain\Product\ProductsCollection;

interface ProductsCollectionSpecificationInterface
{
    public function isSatisfiedBy(ProductsCollection $productsCollection): bool;
}
