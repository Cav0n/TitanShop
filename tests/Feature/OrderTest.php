<?php

namespace Tests\Feature;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    public function testCompleteCreation()
    {
        $billingAddress = AddressTest::create();
        $billingAddress->save();

        $shippingAddress = AddressTest::create();
        $shippingAddress->save();

        // Test simple order creation
        $order = self::create(
            null,
            null,
            $shippingAddress->id,
            $billingAddress->id
        );

        $order->save();
        $this->assertNotNull($order);
        $this->assertNotNull($order->shippingAddress);
        $this->assertNotNull($order->billingAddress);

        // Create product for item
        $product = ProductTest::create();
        $product->save();

        // Test item creation
        $item = self::createItem($order, null, $product->id);
        $item->save();
        $this->assertNotNull($item);
        $this->assertEquals(1, count($order->items));
    }

    public static function create(
        $token = null,
        $customer_id = null,
        $shipping_address_id,
        $billing_address_id,
        $email = null,
        $phone = null,
        $paymentMethod = 'cheque'
    ) {
        $order = new Order();
        $order->token = $token ?? uniqid();
        $order->customer_id = $customer_id;
        $order->shipping_address_id = $shipping_address_id;
        $order->billing_address_id = $billing_address_id;
        $order->email = $email ?? 'florian@test.fr';
        $order->phone = $phone;
        $order->paymentMethod = $paymentMethod;

        return $order;
    }

    public static function createItem(
        Order $order,
        CartItem $cartItem = null,
        $product_id = null,
        $title = null,
        $price = null,
        $quantity = null
    ) {
        $item = new OrderItem(null, $cartItem, $order);
        $item->product_id = $product_id;
        $item->title = $title ?? 'Un produit de test';
        $item->price = $price ?? "10.99";
        $item->quantity = $quantity ?? 1;

        return $item;
    }
}
