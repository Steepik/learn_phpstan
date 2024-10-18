<?php

declare(strict_types=1);

namespace Shop\Cart\Product;

/**
 * @template T of Product<mixed>
 * @implements \ArrayAccess<string, T>
 * @implements \IteratorAggregate<string, T>
 */
final class ProductCollection implements \ArrayAccess, \IteratorAggregate
{
    /** @var array<string, T> */
    private array $items = [];

    /**
     * @param array<int, T> $items
     */
    public function __construct(
        array $items = []
    ) {
        foreach ($items as $item) {
            $this->items[$item->uuid->toString()] = $item;
        }
    }

    /**
     * @param string $offset
     */
    public function offsetExists(mixed $offset): bool
    {
        return array_key_exists($offset, $this->items);
    }

    /**
     * @param string $offset
     * @return T
     */
    public function offsetGet(mixed $offset): mixed
    {
        return $this->items[$offset];
    }

    /**
     * @param string $offset
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->items[$offset] = $value;
    }

    /**
     * @param string $offset
     */
    public function offsetUnset(mixed $offset): void
    {
        unset($this->items[$offset]);
    }

    /**
     * @return \Generator<string, T>
     */
    public function getIterator(): \Generator
    {
        foreach ($this->items as $key => $item) {
            yield $key => $item;
        }
    }
}