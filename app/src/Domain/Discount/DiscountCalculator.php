<?php

declare(strict_types=1);

namespace App\Domain\Discount;

use App\Domain\Discount\Rules\DiscountRuleInterface;
use App\Domain\Discount\Rules\ProductsCollectionDiscountRuleInterface;
use App\Domain\Discount\Rules\SingleProductDiscountRuleInterface;
use App\Domain\Exception\DomainLogicException;
use App\Domain\Price\PriceInterface;
use App\Domain\Product\ProductInterface;
use App\Domain\Product\ProductsCollection;

class DiscountCalculator
{
    /**
     * @param DiscountRuleInterface[] $discountRules
     */
    public function __construct(
        private readonly array $discountRules
    ) {
    }

    /**
     * @throws DomainLogicException
     */
    public function getTotalDiscountedPriceForProductsCollection(ProductsCollection $productsCollection): PriceInterface
    {
        $productsCollection = clone $productsCollection;

        foreach ($productsCollection as $product) {
            $this->applyPriceAfterDiscountForSingleProduct($product);
        }

        $totalPrice = $productsCollection->getTotalPrice();
        $this->applyPriceAfterDiscountForCollection($productsCollection, $totalPrice);

        return $totalPrice;
    }

    private function applyPriceAfterDiscountForSingleProduct(ProductInterface $product): void
    {
        foreach ($this->discountRules as $discountRule) {
            if (!$discountRule instanceof SingleProductDiscountRuleInterface) {
                continue;
            }

            foreach ($discountRule->getSpecifications() as $specification) {
                if (false === $specification->isSatisfiedBy($product)) {
                    return;
                }
            }

            foreach ($discountRule->getPolicies() as $policy) {
                $policy->apply($product->getPrice());
            }
        }
    }

    private function applyPriceAfterDiscountForCollection(
        ProductsCollection $productsCollection,
        PriceInterface $totalPrice,
    ): void {
        foreach ($this->discountRules as $discountRule) {
            if (!$discountRule instanceof ProductsCollectionDiscountRuleInterface) {
                continue;
            }

            foreach ($discountRule as $specification) {
                if (false === $specification->isSatisfiedBy($productsCollection)) {
                    return;
                }
            }

            foreach ($discountRule->getPolicies() as $policy) {
                $policy->apply($totalPrice);
            }
        }
    }
}
