<?php

declare(strict_types=1);

namespace App\Tests\Unit\Domain\Price;

use App\Domain\Exception\ValidationException;
use App\Domain\Price\CurrencyCode;
use App\Domain\Price\Price;
use PHPUnit\Framework\TestCase;

class PriceTest extends TestCase
{
    public function testCreateWithNegativeAmountShouldThrowException(): void
    {
        self::expectException(ValidationException::class);
        new Price(-1000, new CurrencyCode('USD'));
    }

    public function testApplyDiscountShouldSubtractAmount(): void
    {
        $price = new Price(100, new CurrencyCode('PLN'));
        $price->applyFixedDiscount(30);

        self::assertEquals(70, $price->getAmount());
    }

    public function testApplyDiscountBiggerThanAmountShouldSetAmountTo0(): void
    {
        $price = new Price(100, new CurrencyCode('PLN'));
        $price->applyFixedDiscount(200);

        self::assertEquals(0, $price->getAmount());
    }

    public function testApplyPercentageDiscountShouldSubtractAmount(): void
    {
        $price = new Price(100, new CurrencyCode('PLN'));
        $price->applyPercentageDiscount(50);

        self::assertEquals(50, $price->getAmount());
    }

    public function testAddShouldAddToAmount(): void
    {
        $price = new Price(100, new CurrencyCode('PLN'));
        $price->add(50);

        self::assertEquals(150, $price->getAmount());
    }

    public function testMultiplyShouldMultiplyAmount(): void
    {
        $price = new Price(100, new CurrencyCode('PLN'));
        $price->multiply(3);

        self::assertEquals(300, $price->getAmount());
    }
}
