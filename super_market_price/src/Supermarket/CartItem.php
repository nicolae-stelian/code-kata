<?php


namespace Supermarket;


class CartItem
{
    /** @var  Product $product */
    public $product;
    public $quantity;

    public function __construct(Product $product, $quantity)
    {
        $this->product = $product;
        $this->quantity = $quantity;
    }
} 