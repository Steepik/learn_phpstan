<?php

declare(strict_types=1);

namespace Shop\Cart\Product;

use Money\Money;

/**
 * @template T
 */
abstract class Product
{
    /**
     * @param non-empty-string $id
     * @param non-empty-string $name
     * @param Money $price
     */
    public function __construct(
        public string $id,
        public string $name,
        public Money $price
    ) {}
}