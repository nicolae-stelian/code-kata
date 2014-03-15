<?php


namespace Supermarket\Offers;


use Supermarket\CartItem;

interface Offer
{
    public function apply(CartItem $item);
}