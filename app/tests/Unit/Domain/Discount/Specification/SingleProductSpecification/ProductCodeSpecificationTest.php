<?php

declare(strict_types=1);

namespace App\Tests\Unit\Domain\Discount\Specification\SingleProductSpecification;

use App\Domain\Discount\Specification\SingleProductSpecification\ProductCodeSpecification;
use App\Domain\Price\CurrencyCode;
use App\Domain\Price\Price;
use App\Domain\Product\Product;
use App\Domain\Product\ProductCode;
use App\Domain\Product\ProductCodesCollection;
use PHPUnit\Framework\TestCase;

class ProductCodeSpecificationTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function testIsSatisfiedBy(string $code, bool $expectedResult): void
    {
        // given
        $specification = new ProductCodeSpecification(
            new ProductCodesCollection(
                ...[
                    new ProductCode('XYZ'),
                    new ProductCode('ABC'),
                ],
            ),
        );

        // when then
        $result = $specification->isSatisfiedBy(
            new Product(
                new ProductCode($code),
                new Price(150, new CurrencyCode('PLN')),
                1,
            ),
        );

        self::assertEquals($expectedResult, $result);
    }

    public function dataProvider(): \Traversable
    {
        yield ['XYZ', true];
        yield ['ABC', true];
        yield ['WWW', false];
        yield ['AAA', false];
    }
}
