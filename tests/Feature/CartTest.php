<?php

namespace Tests\Feature;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CartTest extends TestCase
{
    use RefreshDatabase;

    public function testCompleteCreation()
    {
        // Test simple cart creation
        $cart = self::create();
        $cart->save();
        $this->assertNotNull($cart);

        // Create product for item
        $product = ProductTest::create();
        $product->save();

        // Test item creation
        $item = self::createItem($cart->id, $product->id);
        $item->save();
        $this->assertNotNull($item);
        $this->assertEquals(1, count($cart->items));
    }

    public static function create(
        $customer_id = null,
        $token = null,
        $isActive = null
    ) {
        $cart = new Cart();
        $cart->customer_id = $customer_id;
        $cart->token = $token ?? uniqid();
        $cart->isActive = $isActive ?? 1;

        return $cart;
    }

    public static function createItem(
        $cart_id,
        $product_id,
        $quantity = null
    ) {
        $item = new CartItem();
        $item->cart_id = $cart_id;
        $item->product_id = $product_id;
        $item->quantity = $quantity ?? 1;

        return $item;
    }  
}
