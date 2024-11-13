<?php

declare(strict_types=1);

namespace App\Domain\Discount\Specification\SingleProductSpecification;

use App\Domain\Product\ProductCodesCollection;
use App\Domain\Product\ProductInterface;

class ProductCodeSpecification implements SingleProductSpecificationInterface
{
    public function __construct(
        private readonly ProductCodesCollection $productCodesCollection,
    ) {
    }

    public function isSatisfiedBy(ProductInterface $product): bool
    {
        return $this->productCodesCollection->contains($product->getCode());
    }
}
