<?php


namespace Supermarket\Offers;


use Supermarket\CartItem;

class OffersCollection
{
    protected $_offers = array();

    public function add(Offer $offer)
    {
        $this->_offers[] = $offer;
    }

    public function getPrice(CartItem $item)
    {
        $price = $item->product->getPrice() * $item->quantity;

        // apply only one offer for a product, and that is first find it offer
        foreach ($this->_offers as $offer) {
            /** @var Offer $offer */
            $price = $offer->apply($item);
        }

        return $price;
    }
}