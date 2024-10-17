<?php

declare(strict_types=1);

namespace Shop\Cart;

use Money\Money;
use Shop\Cart\Product\Product;

/**
 * @template T of Product
 */
final readonly class Cart
{
    /**
     * @param array<int, T> $products
     */
    public function __construct(
        public array $products
    ) {}

    /**
     * @param T $product
     * @return self<T>
     */
    public function add(Product $product): self
    {
        return new self(
            array_merge($this->products, [$product]),
        );
    }

    public function totalAmount(): string
    {
        return array_reduce(
            $this->products,
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