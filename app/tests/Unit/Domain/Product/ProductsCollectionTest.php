<?php

declare(strict_types=1);

namespace App\Tests\Unit\Domain\Product;

use App\Domain\Product\ProductInterface;
use App\Domain\Product\ProductsCollection;
use PHPUnit\Framework\TestCase;

class ProductsCollectionTest extends TestCase
{
    public function testCountShouldReturnValidInteger(): void
    {
        // given
        $collection = new ProductsCollection(...[
            $this->createMock(ProductInterface::class),
            $this->createMock(ProductInterface::class),
            $this->createMock(ProductInterface::class),
            $this->createMock(ProductInterface::class),
            $this->createMock(ProductInterface::class),
        ]);

        // when then
        self::assertCount(5, $collection);
    }

    public function testIterateShouldIterateThroughElements(): void
    {
        // given
        $collection = new ProductsCollection(...[
            $this->createMock(ProductInterface::class),
            $this->createMock(ProductInterface::class),
            $this->createMock(ProductInterface::class),
            $this->createMock(ProductInterface::class),
        ]);
        $i = 0;

        // when
        foreach ($collection as $item) {
            self::assertInstanceOf(ProductInterface::class, $item);
            $i++;
        }

        // then
        self::assertEquals(4, $i);
    }
}
