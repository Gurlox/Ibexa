<?php

declare(strict_types=1);

namespace App\Domain\Product;

/**
 * @implements \IteratorAggregate<ProductCode>
 */
class ProductCodesCollection implements \Countable, \IteratorAggregate
{
    private \ArrayIterator $codes;

    public function __construct(ProductCode ...$code)
    {
        $this->codes = new \ArrayIterator($code);
    }

    /**
     * @return ProductCode[]
     */
    public function toArray(): array
    {
        return iterator_to_array($this->codes, false);
    }

    public function getIterator(): \Traversable
    {
        return $this->codes;
    }

    public function count(): int
    {
        return count($this->codes);
    }

    public function contains(ProductCode $productCode): bool
    {
        foreach ($this->getIterator() as $code) {
            if ($code->getCode() == $productCode->getCode()) {
                return true;
            }
        }

        return false;
    }
}
