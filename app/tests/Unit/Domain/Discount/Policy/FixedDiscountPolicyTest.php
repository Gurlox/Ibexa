<?php

declare(strict_types=1);

namespace App\Tests\Unit\Domain\Discount\Policy;

use App\Domain\Discount\Policy\FixedDiscountPolicy;
use App\Domain\Price\CurrencyCode;
use App\Domain\Price\Price;
use PHPUnit\Framework\TestCase;

class FixedDiscountPolicyTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function testApplyShouldReducePrice(int $discount, int $beforeDiscount, int $result): void
    {
        // given
        $policy = new FixedDiscountPolicy($discount);
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
        yield [10, 11, 1];
        yield [10, 10, 0];
    }
}
