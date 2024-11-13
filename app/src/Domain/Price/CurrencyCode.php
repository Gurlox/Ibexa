<?php

declare(strict_types=1);

namespace App\Domain\Price;

use App\Domain\Exception\ValidationException;

class CurrencyCode implements \Stringable
{
    private string $currencyCode;

    public function __construct(string $currencyCode)
    {
        $this->validate($currencyCode);

        $this->currencyCode = $currencyCode;
    }

    public function getCurrencyCode(): string
    {
        return $this->currencyCode;
    }

    public function __toString(): string
    {
        return $this->currencyCode;
    }

    private function validate(string $currencyCode): void
    {
        if (!\preg_match("/^[A-Z]{3}$/", $currencyCode)) {
            throw new ValidationException("Incorrect currency code, $currencyCode given.");
        }
    }
}
