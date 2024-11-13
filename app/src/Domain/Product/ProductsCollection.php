<?php

declare(strict_types=1);

namespace App\Domain\Product;

use App\Domain\Exception\DomainLogicException;
use App\Domain\Price\PriceInterface;

/**
 * @implements \IteratorAggregate<ProductInterface>
 */
class ProductsCollection implements \Countable, \IteratorAggregate
{
    private \ArrayIterator $products;

    public function __construct(ProductInterface ...$product)
    {
        $this->products = new \ArrayIterator($product);
    }

    /**
     * @return ProductInterface[]
     */
    public function toArray(): array
    {
        return iterator_to_array($this->products, false);
    }

    public function getIterator(): \Traversable
    {
        return $this->products;
    }

    public function count(): int
    {
        return count($this->products);
    }

    public function countWithQuantity(): int
    {
        $count = 0;

        foreach ($this->getIterator() as $product) {
            /** @var ProductInterface $product */
            $count += $product->getQuantity();
        }

        return $count;
    }

    /**
     * @throws DomainLogicException
     */
    public function getTotalPrice(): PriceInterface
    {
        if ($this->count() < 1) {
            throw new DomainLogicException('Cannot calculate price for empty products collection');
        }

        $price = null;

        foreach ($this->getIterator() as $product) {
            /** @var ProductInterface $product */
            if (null === $price) {
                $price = clone $product->getTotalPrice();
                continue;
            }

            /** @var PriceInterface $price */
            if ($product->getPrice()->getCurrency()->getCurrencyCode() !== $price->getCurrency()->getCurrencyCode()) {
                throw new DomainLogicException('Cannot calculate total price for multiple currencies');
            }

            $price->add($product->getTotalPrice()->getAmount());
        }

        return $price;
    }
}
