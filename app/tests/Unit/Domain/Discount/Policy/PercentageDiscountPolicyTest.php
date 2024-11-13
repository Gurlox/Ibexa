<?php

declare(strict_types=1);

namespace App\Tests\Unit\Domain\Discount\Policy;

use App\Domain\Discount\Policy\PercentageDiscountPolicy;
use App\Domain\Price\CurrencyCode;
use App\Domain\Price\Price;
use PHPUnit\Framework\TestCase;

class PercentageDiscountPolicyTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function testApplyShouldReducePrice(int $discount, int $beforeDiscount, int $result): void
    {
        // given
        $policy = new PercentageDiscountPolicy($discount);
        $price = new Price($beforeDiscount, new CurrencyCode('PLN'));

        // when
        $policy->apply($price);

        // then
        self::assertEquals($result, $price->getAmount());
    }

    public function dataProvider(): \Traversable
    {
        yield [20, 100, 80];
        yield [100, 50, 0];
        yield [10, 10, 9];
        yield [0, 100, 100];
        yield [2, 100, 98];
    }
}
