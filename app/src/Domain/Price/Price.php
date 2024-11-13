<?php

declare(strict_types=1);

namespace App\Domain\Price;

use App\Domain\Exception\ValidationException;

class Price implements PriceInterface
{
    private int $amount;

    public function __construct(
        int $amount,
        private readonly CurrencyCode $currencyCode,
    ) {
        $this->validateAmount($amount);
        $this->amount = $amount;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getCurrency(): CurrencyCode
    {
        return $this->currencyCode;
    }

    public function applyFixedDiscount(int $amount): self
    {
        $newAmount = $this->amount - $amount;

        if ($newAmount < 0) {
            $newAmount = 0;
        }

        $this->amount = $newAmount;

        return $this;
    }

    public function applyPercentageDiscount(int $percentage): self
    {
        $this->applyFixedDiscount((int) ($this->amount * ($percentage / 100)));

        return $this;
    }

    /**
     * @throws ValidationException
     */
    public function add(int $amount): self
    {
        $this->validateAmount($amount);
        $this->amount += $amount;

        return $this;
    }

    public function multiply(int $multiplier): PriceInterface
    {
        $this->amount *= $multiplier;

        return $this;
    }

    /**
     * @throws ValidationException
     */
    private function validateAmount(int $amount): void
    {
        if ($amount < 0) {
            throw new ValidationException('Invalid amount provided for price');
        }
    }
}
