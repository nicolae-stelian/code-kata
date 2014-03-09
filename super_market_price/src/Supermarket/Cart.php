<?php


namespace Supermarket;


use Supermarket\Offers\OffersCollection;

class Cart
{
    protected $_products = array();
    /**
     * @var OffersCollection
     */
    protected $_offers;

    public function __construct()
    {
        $this->_offers = new OffersCollection();
    }

    public function add(CartItem $item)
    {
        $barcode = $item->product->getBarcode();
        if (array_key_exists($barcode, $this->_products)) {
            $this->_products[$barcode]->quantity += $item->quantity;
        } else {
            $this->_products[$barcode] = $item;
        }
    }

    public function checkout()
    {
        $total = 0;
        /** @var CartItem $item */
        foreach ($this->_products as $item) {
            $total += $this->calculatePriceForItemCart($item);
        }
        return $total;
    }

    public function countProducts()
    {
        return count($this->_products);
    }

    public function setOffers(OffersCollection $offers)
    {
        $this->_offers = $offers;
    }

    /**
     * @param CartItem $item
     *
     * @return float
     */
    private function calculatePriceForItemCart(CartItem $item)
    {
        return  $this->_offers->getPrice($item);
    }
}