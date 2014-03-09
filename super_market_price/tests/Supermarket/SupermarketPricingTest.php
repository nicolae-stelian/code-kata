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

    /**
     * @test
     */
    public function cartCheckout_WithOneProductWithFixedPrice()
    {
        $cart = new Cart();
        $product = new Product("product", "utd", 0.65);
        $cart->add(new CartItem($product, 2));
        $this->assertEquals(2 * 0.65, $cart->checkout());
    }

    /**
     * @test
     */
    public function cartCheckout_WithTwoProductsWithFixedPrice()
    {
        $cart = new Cart();
        $product = new Product("product", "utd", 0.65);
        $cart->add( new CartItem($product, 2));
        $cart->add(new CartItem($product, 5));
        $this->assertEquals(7 * 0.65, $cart->checkout());
    }

    /**
     * @test
     */
    public function countCartProduct_WhenEmptyCart_MustBeZero()
    {
        $cart = new Cart();
        $this->assertEquals(0, $cart->countProducts());
    }

    /**
     * @test
     */
    public function countCartProduct_WhenCartHaveOneProduct()
    {
        $cart = new Cart();
        $product = new Product("product", "utd", 0.65);
        $cart->add( new CartItem($product, 2));
        $cart->add(new CartItem($product, 5));
        $this->assertEquals(1, $cart->countProducts());
    }

    /**
     * @test
     */
    public function countCartProduct_WhenCartHaveTwoProduct()
    {
        $cart = new Cart();
        $product1 = new Product("product 1", "utd", 0.65);
        $cart->add( new CartItem($product1, 2));

        $product2 = new Product("product 2", "utd", 1.20);
        $cart->add( new CartItem($product2, 2));

        $this->assertEquals(2, $cart->countProducts());
    }

    /**
     * @test
     */
    public function cartPriceOffers_TreeForAnEuro()
    {
        $offers = new OffersCollection();
        $product = new Product("product", "utd", 0.65);
        $offers->add(new OfferPricePorQuantity($product->getBarcode(), 3, 1));
        $cart = new Cart();
        $cart->setOffers($offers);

        $cart->add(new CartItem($product, 8));
        $this->assertEquals(2 * 1 + 2 * 0.65, $cart->checkout());
    }

}


 