<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Cart;

class CartTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic cart creation test
     *
     * @return void
     */
    public function testSimpleCreation()
    {
        $cart = self::createSimpleCart();

        $this->assertNotNull($cart);
    }

    /**
     * A cart creation test with one item
     *
     * @return void
     */
    public function testCreationWithOneItem()
    {
        $cart = self::createCartWithItems();

        $this->assertNotNull($cart);
        $this->assertNotNull($cart->items);
        $this->assertEquals(1, count($cart->items));
    }

    /**
     * A cart creation test with mutliple items
     *
     * @return void
     */
    public function testCreationWithMutlipleItems()
    {
        $cart = self::createCartWithItems(10);

        $this->assertNotNull($cart);
        $this->assertNotNull($cart->items);
        $this->assertEquals(10, count($cart->items));
    }

    /**
     * A cart creation test with shipping and billing addresses
     *
     * @return void
     */
    public function testCreationWithAddresses()
    {
        $cart = self::createSimpleCart();
        $shippingAddress = AddressTest::createCompleteAddress();
        $billingAddress = AddressTest::createCompleteAddress();

        $cart->shipping_address_id = $shippingAddress->id;
        $cart->billing_address_id = $billingAddress->id;

        $this->assertNotNull($cart);
        $this->assertNotNull($cart->shippingAddress);
        $this->assertNotNull($cart->billingAddress);
    }

    /**
     * Create a simple cart
     *
     * @return Cart
     */
    public static function createSimpleCart()
    {
        $cart = new Cart();
        $cart->generateToken();
        $cart->save();

        return $cart;
    }

    /**
     * Create a cart with one item
     *
     * @return Cart
     */
    public static function createCartWithItems($numberOfItems = 1)
    {
        $cart = new Cart();
        $cart->generateToken();
        $cart->save();

        for ($i = 1; $i <= $numberOfItems; $i++) {
            $item = CartItemTest::createCompleteCartItem($cart);
        }

        return $cart;
    }
}
