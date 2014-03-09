<?php


namespace Supermarket\Offers;


use Supermarket\CartItem;

class OfferPricePorQuantity implements Offer
{
    protected $_barcode;
    protected $_quantity;
    protected $_newPrice;

    public function __construct($barcode, $quantity, $newPrice)
    {
        $this->_barcode = $barcode;
        $this->_quantity = $quantity;
        $this->_newPrice = $newPrice;
    }

    public function apply(CartItem $item)
    {
        $price = 0;
        if ($item->product->getBarcode() == $this->_barcode) {
            $quantity = $item->quantity;
            while ($quantity > $this->_quantity) {
                $quantity -= $this->_quantity;
                $price += $this->_newPrice;
            }
            if ($quantity > 0) {
                $price += $item->product->getPrice() * $quantity;
            }
        }

        return $price;
    }
}