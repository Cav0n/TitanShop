<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\CartItem;

class CartItemTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A complete cart item creation test
     *
     * @return void
     */
    public function testCompleteCreation()
    {
        $item = self::createCompleteCartItem();

        $this->assertNotNull($item);
        $this->assertNotNull($item->cart);
        $this->assertNotNull($item->product);
    }

    /**
     * Create a complete cart item
     *
     * @return User
     */
    public static function createCompleteCartItem($cart = null, $product = null)
    {
        $cart = $cart ?? CartTest::createSimpleCart();
        $product = $producy ?? ProductTest::createCompleteProduct();

        $item = new CartItem();
        $item->quantity = 1;
        $item->cart_id = $cart->id;
        $item->product_id = $product->id;
        $item->save();

        return $item;
    }
}
