<?php
namespace SupermarketTest;

require_once '../bootstrap.php';

use Supermarket\Cart;
use Supermarket\CartItem;
use Supermarket\Offers\OfferPricePorQuantity;
use Supermarket\Offers\OffersCollection;
use Supermarket\Product;

class SupermarketPricingTest extends \PHPUnit_Framework_TestCase
{
    /** @var  Product */
    protected $product;
    /** @var Cart */
    protected $cart;

    public function setUp()
    {
        $this->product = new Product("product", "utd", 0.65);
        $this->cart = new Cart();
    }



    /**
     * @test
     */
    public function count_cart_products_must_be_zero_when_cart_is_empty()
    {
        $this->assertEquals(0, $this->cart->countProducts());
    }

    /**
     * @test
     */
    public function count_cart_products_must_be_one_when_cart_have_one_product()
    {
        $this->cart->add( new CartItem($this->product, 2));
        $this->cart->add(new CartItem($this->product, 5));
        $this->assertEquals(1, $this->cart->countProducts());
    }

    /**
     * @test
     */
    public function count_cart_products_must_be_two_when_cart_have_two_products()
    {
        $this->cart->add( new CartItem($this->product, 2));
        $product2 = new Product("product 2", "utd", 1.20);
        $this->cart->add( new CartItem($product2, 2));
        $this->assertEquals(2, $this->cart->countProducts());
    }

    /**
     * @test
     */
    public function it_should_calculate_cart_total_when_have_one_product()
    {
        $productQuantity = 2;
        $this->cart->add(new CartItem($this->product, $productQuantity));
        $expectedTotal = $productQuantity * $this->product->getPrice();
        $this->assertEquals($expectedTotal, $this->cart->checkout());
    }

    /**
     * @test
     */
    public function it_should_calculate_cart_total_when_have_one_product_more_times()
    {

        $this->cart->add( new CartItem($this->product, 2));
        $this->cart->add(new CartItem($this->product, 5));
        $this->assertEquals(7 * $this->product->getPrice(), $this->cart->checkout());
    }

    /**
     * @test
     */
    public function it_should_calculate_cart_total_when_have_an_offer_3_for_1()
    {
        $offers = new OffersCollection();
        $offers->add(new OfferPricePorQuantity($this->product->getBarcode(), 3, 1));
        $this->cart->setOffers($offers);
        $this->cart->add(new CartItem($this->product, 8));
        $this->assertEquals(2 * 1 + 2 * 0.65, $this->cart->checkout());
    }
}


 