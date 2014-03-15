<?php


namespace Supermarket;


class Product
{
    protected $_name;
    protected $_price;
    protected $_unity;
    protected $_barcode;

    public function __construct($name, $unity, $price)
    {
        $this->_name = $name;
        $this->_unity = $unity;
        $this->_price = $price;
        $this->_barcode = sha1($name . $unity . $price);
    }

    public function getPrice()
    {
        return $this->_price;
    }

    public function getBarcode()
    {
        return $this->_barcode;
    }
} 