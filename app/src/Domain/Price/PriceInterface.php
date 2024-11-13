<?php

declare(strict_types=1);

namespace App\Domain\Price;

interface PriceInterface
{
    public function getAmount(): int;

    public function getCurrency(): CurrencyCode;

    public function applyFixedDiscount(int $amount): self;

    public function applyPercentageDiscount(int $percentage): self;

    public function add(int $amount): self;

    public function multiply(int $multiplier): self;
}
