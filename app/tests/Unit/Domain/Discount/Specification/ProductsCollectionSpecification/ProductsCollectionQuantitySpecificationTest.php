<?php

declare(strict_types=1);

namespace App\Tests\Unit\Domain\Discount\Specification\ProductsCollectionSpecification;

use App\Domain\Discount\Specification\ProductsCollectionSpecification\ProductsCollectionQuantitySpecification;
use App\Domain\Price\CurrencyCode;
use App\Domain\Price\Price;
use App\Domain\Product\Product;
use App\Domain\Product\ProductCode;
use App\Domain\Product\ProductsCollection;
use PHPUnit\Framework\TestCase;

class ProductsCollectionQuantitySpecificationTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function testIsSatisfiedBy(int $quantity, bool $expectedResult): void
    {
        // given
        $specification = new ProductsCollectionQuantitySpecification(10);
        $collection = new ProductsCollection(
            ...[
                new Product(
                    new ProductCode('ABC'),
                    new Price(150, new CurrencyCode('PLN')),
                    $quantity,
                ),
            ],
        );

        // when then
        self::assertEquals($expectedResult, $specification->isSatisfiedBy($collection));
    }

    public function dataProvider(): \Traversable
    {
        yield [10, true];
        yield [8, false];
        yield [11, true];
    }
}
