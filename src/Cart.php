<?php

declare(strict_types=1);

namespace Shop\Cart;

use Money\Money;
use Shop\Cart\Product\Product;
use Shop\Cart\Product\ProductCollection;

/**
 * @template T of Product<mixed>
 */
final readonly class Cart
{
    /**
     * @param ProductCollection<T> $products
     */
    public function __construct(
        public ProductCollection $products
    ) {}

    /**
     * @param non-empty-array<int, T> $products
     * @return self<T>
     */
    public function add(array $products): self
    {
        return new self(
            new ProductCollection(
                array_merge(iterator_to_array($this->products, false), $products)
            ),
        );
    }

    /**
     * @param non-empty-string $uuid
     * @return self<T>
     */
    public function remove(string $uuid): self
    {
        $products = $this->products;
        unset($products[$uuid]);

        return new self(
            new ProductCollection(
                iterator_to_array($products, false)
            ),
        );
    }

    public function totalAmount(): string
    {
        return array_reduce(
            iterator_to_array($this->products),
            $this->calculateTotalPrice(),
            Money::RUB(0),
        )->getAmount();
    }

    private function calculateTotalPrice(): \Closure
    {
        return static function (Money $carry, Product $product): Money {
            return $carry->add($product->price);
        };
    }
}