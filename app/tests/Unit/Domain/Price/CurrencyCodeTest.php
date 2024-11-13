<?php

declare(strict_types=1);

namespace App\Tests\Unit\Domain\Price;

use App\Domain\Exception\ValidationException;
use App\Domain\Price\CurrencyCode;
use PHPUnit\Framework\TestCase;

class CurrencyCodeTest extends TestCase
{
    /**
     * @dataProvider validCurrencyCodesProvider
     */
    public function testItSetsValuesProperly(string $currencyCodeString): void
    {
        $currencyCode = new CurrencyCode($currencyCodeString);

        $this->assertEquals($currencyCodeString, $currencyCode->getCurrencyCode());
    }

    /**
     * @dataProvider invalidCurrencyCodesProvider
     */
    public function testItThrowsExceptionWhenCurrencyCodeIsInvalid(string $currencyCodeString): void
    {
        $this->expectException(ValidationException::class);

        new CurrencyCode($currencyCodeString);
    }

    public function validCurrencyCodesProvider(): \Traversable
    {
        yield ['USD'];
        yield ['PLN'];
        yield ['CHF'];
    }

    public function invalidCurrencyCodesProvider(): \Traversable
    {
        yield '1 character lowercase' => ['u'];
        yield '1 character uppercase' => ['U'];
        yield '2 characters lowercase' => ['us'];
        yield 'characters uppercase' => ['US'];
        yield '3 characters lowercase' => ['usd'];
        yield '4 characters lowercase' => ['usdd'];
        yield '4 characters uppercase' => ['USDD'];
    }
}
