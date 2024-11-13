<?php

declare(strict_types=1);

namespace App\Domain\Discount\Specification\SingleProductSpecification;

use App\Domain\Product\ProductInterface;

interface SingleProductSpecificationInterface
{
    public function isSatisfiedBy(ProductInterface $product): bool;

}
