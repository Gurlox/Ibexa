<?php

declare(strict_types=1);

namespace App\Tests\Unit\Domain\Product;

use App\Domain\Exception\ValidationException;
use App\Domain\Price\CurrencyCode;
use App\Domain\Price\Price;
use App\Domain\Product\Product;
use App\Domain\Product\ProductCode;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    /**
     * @dataProvider invalidDataProvider
     */
    public function testCreateWithInvalidDataShouldThrowException(int $quantity): void
    {
        self::expectException(ValidationException::class);
        new Product(
            new ProductCode('ABC'),
            new Price(150, new CurrencyCode('ABC')),
            $quantity,
        );
    }

    public function invalidDataProvider(): \Traversable
    {
        yield [0];
        yield [-1];
        yield [-3300];
    }
}
