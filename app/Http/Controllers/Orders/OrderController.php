<?php

namespace App\Http\Controllers\Orders;

use App\Cart;
use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\OrderItem;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::all();
        return view('themes.default.pages.admin.orders')->with(['orders' => $orders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('themes.default.pages.admin.order');
    }

    /**
     * Create order from current cart
     *
     * @param  Cart $cart
     * @return void
     */
    public function createFromCart($cart = null)
    {
        if (! isset($cart)) {
            $cart = session('cart');
        }

        $order = new Order();
        $order->shippingCosts = $cart->shippingCosts;
        $order->shipping_address_id = $cart->shippingAddress->id;
        $order->billing_address_id = $cart->billingAddress->id;
        $order->user_id = $cart->user_id;
        $order->status_id = \App\OrderStatus::where('code', 'WAITING_PAYMENT')->first()->id;
        $order->generateTrackingNumber();

        $order->save();

        foreach ($cart->items as $cartItem) {
            $orderItem = new OrderItem();
            $orderItem->quantity = $cartItem->quantity;
            $orderItem->price = $cartItem->product->price;
            $orderItem->productName = $cartItem->product->title;
            $orderItem->product_id = $cartItem->product->id;
            $orderItem->order_id = $order->id;

            $orderItem->save();
        }

        return $order;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        return view('themes.default.pages.admin.order', ['order' => $order]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
