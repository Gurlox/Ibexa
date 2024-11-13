<?php

declare(strict_types=1);

namespace App\Tests\Unit\Domain\Product;

use App\Domain\Exception\ValidationException;
use App\Domain\Product\ProductCode;
use PHPUnit\Framework\TestCase;

class ProductCodeTest extends TestCase
{
    /**
     * @dataProvider invalidDataProvider
     */
    public function testCreateWithInvalidCodeShouldThrowException(string $code): void
    {
        self::expectException(ValidationException::class);
        new ProductCode($code);
    }

    public function invalidDataProvider(): \Traversable
    {
        yield [''];
        yield[ '-----'];
        yield ['lp[lp[l;;;;'];
        yield ['AAAAAAAAAAAAAAAAAAAAAAAA'];
        yield [' '];
        yield ['ZYX '];
        yield [' ZXY'];
        yield ['X YZ'];
    }

    /**
     * @dataProvider validDataProvider
     */
    public function testCreateWithValidCodeShouldCreate(string $code): void
    {
        self::assertEquals($code, (new ProductCode($code))->getCode());
    }

    public function validDataProvider(): \Traversable
    {
        yield ['ABC'];
        yield ['AB'];
        yield ['AAAAAAA'];
        yield ['A'];
        yield ['XYZ'];
    }
}
