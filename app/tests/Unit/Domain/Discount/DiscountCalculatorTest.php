<?php

declare(strict_types=1);

namespace App\Tests\Unit\Domain\Discount;

use App\Domain\Discount\DiscountCalculator;
use App\Domain\Discount\Rules\FixedProductDiscount;
use App\Domain\Discount\Rules\PercentageProductDiscount;
use App\Domain\Discount\Rules\VolumeDiscount;
use App\Domain\Price\CurrencyCode;
use App\Domain\Price\Price;
use App\Domain\Product\Product;
use App\Domain\Product\ProductCode;
use App\Domain\Product\ProductsCollection;
use PHPUnit\Framework\TestCase;

class DiscountCalculatorTest extends TestCase
{
    public function testGetTotalDiscountedPriceForProductsCollectionWithFixedProductDiscount(): void
    {
        // given
        $currency = new CurrencyCode('PLN');
        $discountCalculator = new DiscountCalculator([
            new FixedProductDiscount(),
        ]);

        $productsCollection = new ProductsCollection(
            ...[
                new Product(
                    new ProductCode('ABC'),
                    new Price(150, $currency),
                    2,
                ),
                new Product(
                    new ProductCode('XYZ'),
                    new Price(10, $currency),
                    1,
                ),
            ],
        );

        /// when then
        $result = $discountCalculator->getTotalDiscountedPriceForProductsCollection($productsCollection);

        self::assertEquals($currency, $result->getCurrency());
        self::assertEquals(110, $result->getAmount());
    }

    public function testGetTotalDiscountedPriceForProductsCollectionWithPercentageProductDiscount(): void
    {
        // given
        $currency = new CurrencyCode('PLN');
        $discountCalculator = new DiscountCalculator([
            new PercentageProductDiscount(),
        ]);

        $productsCollection = new ProductsCollection(
            ...[
                new Product(
                    new ProductCode('ABC'),
                    new Price(100, $currency),
                    2,
                ),
                new Product(
                    new ProductCode('XYZ'),
                    new Price(200, $currency),
                    1,
                ),
            ],
        );

        /// when then
        $result = $discountCalculator->getTotalDiscountedPriceForProductsCollection($productsCollection);

        self::assertEquals($currency, $result->getCurrency());
        self::assertEquals(360, $result->getAmount());
    }

    public function testGetTotalDiscountedPriceForProductsCollectionWithVolumeDiscount(): void
    {
        // given
        $currency = new CurrencyCode('PLN');
        $discountCalculator = new DiscountCalculator([
            new VolumeDiscount(),
        ]);

        $productsCollection = new ProductsCollection(
            ...[
                new Product(
                    new ProductCode('ABC'),
                    new Price(100, $currency),
                    8,
                ),
                new Product(
                    new ProductCode('XYZ'),
                    new Price(100, $currency),
                    2,
                ),
            ],
        );

        /// when then
        $result = $discountCalculator->getTotalDiscountedPriceForProductsCollection($productsCollection);

        self::assertEquals($currency, $result->getCurrency());
        self::assertEquals(900, $result->getAmount());
    }

    public function testGetTotalDiscountedPriceForProductsCollectionWithFixedProductDiscountAndVolumeDiscount(): void
    {
        // given
        $currency = new CurrencyCode('PLN');
        $discountCalculator = new DiscountCalculator([
            new FixedProductDiscount(),
            new VolumeDiscount(),
        ]);

        $productsCollection = new ProductsCollection(
            ...[
            new Product(
                new ProductCode('ABC'),
                new Price(120, $currency),
                1,
            ),
            new Product(
                new ProductCode('XYZ'),
                new Price(100, $currency),
                11,
            ),
        ],
        );

        /// when then
        $result = $discountCalculator->getTotalDiscountedPriceForProductsCollection($productsCollection);

        self::assertEquals($currency, $result->getCurrency());
        self::assertEquals(1020, $result->getAmount());
    }
}
