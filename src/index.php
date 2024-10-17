<?php

use Ramsey\Uuid\Uuid;
use Shop\Cart\Cart;
use Shop\Cart\Product\Product;
use Shop\Cart\Product\Type\Hotel;
use Shop\Cart\Product\Type\Ticket;

require_once __DIR__ . "/../vendor/autoload.php";


$products = [];

for ($i = 1; $i <= 1; $i++) {
    $products[] = new Ticket(Uuid::uuid7()->toString(), 'P 1', \Money\Money::RUB(rand(1000, 1500)));
    $products[] = new Hotel(Uuid::uuid7()->toString(), 'P 2', \Money\Money::RUB(rand(15000, 30000)));
}

$cart = new Cart($products);

/** @var Product<mixed> $item */
foreach ($cart->products as $item) {
    echo sprintf('ID: %s - Название: %s - Цена: %s', $item->id, $item->name, $item->price->getAmount()) . PHP_EOL;
}

echo 'Total: ' . $cart->totalAmount();