<?php

declare(strict_types=1);

namespace App\Tests\Unit\Domain\Product;

use App\Domain\Product\ProductCode;
use App\Domain\Product\ProductCodesCollection;
use PHPUnit\Framework\TestCase;

class WalletEventsCollectionTest extends TestCase
{
    public function testCountShouldReturnValidInteger(): void
    {
        // given
        $collection = new ProductCodesCollection(...[
            $this->createMock(ProductCode::class),
            $this->createMock(ProductCode::class),
            $this->createMock(ProductCode::class),
            $this->createMock(ProductCode::class),
            $this->createMock(ProductCode::class),
        ]);

        // when then
        self::assertCount(5, $collection);
    }

    public function testIterateShouldIterateThroughElements(): void
    {
        // given
        $collection = new ProductCodesCollection(...[
            $this->createMock(ProductCode::class),
            $this->createMock(ProductCode::class),
            $this->createMock(ProductCode::class),
            $this->createMock(ProductCode::class),
        ]);
        $i = 0;

        // when
        foreach ($collection as $item) {
            self::assertInstanceOf(ProductCode::class, $item);
            $i++;
        }

        // then
        self::assertEquals(4, $i);
    }
}
