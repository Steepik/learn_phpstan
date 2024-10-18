<?php

declare(strict_types=1);

namespace Shop\Cart\Product;

use Money\Money;
use Ramsey\Uuid\UuidInterface;

/**
 * @template T
 */
abstract class Product
{
    /**
     * @param UuidInterface $uuid
     * @param non-empty-string $name
     * @param Money $price
     */
    public function __construct(
        public UuidInterface $uuid,
        public string $name,
        public Money $price,
        public int $qty,
    ) {}
}