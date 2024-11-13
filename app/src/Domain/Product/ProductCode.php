<?php

declare(strict_types=1);

namespace App\Domain\Product;

use App\Domain\Exception\ValidationException;

class ProductCode implements \Stringable
{
    private string $code;

    public function __construct(string $code)
    {
        $this->validate($code);

        $this->code = $code;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function __toString(): string
    {
        return $this->code;
    }

    private function validate(string $code): void
    {
        if (!preg_match("/^[A-Z]{1,10}$/", $code)) {
            throw new ValidationException('Incorrect code format');
        }
    }
}
