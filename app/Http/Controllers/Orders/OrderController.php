<?php

namespace App\Http\Controllers\Orders;

use App\Cart;
use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\OrderCreated;
use App\OrderItem;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;

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

        try {
            Mail::to($order->user->email)->send(
                new OrderCreated($order));
        } catch (Exception $e) {
            throw $e;
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

    public function tracking()
    {
        return view('themes.default.pages.public.order-tracking');
    }

    public function trackingAPI(Request $request)
    {
        $trackingNumber = $request['t'];

        if (null === $trackingNumber) {
            $message = 'Tracking number is required.';

            return new JsonResponse(['error' => [
                'message' => $message,
                'feedback' => "<div class=\"invalid-feedback\">$message</div>"
            ]], 422);
        }

        if (null === $order = Order::where('trackingNumber', $trackingNumber)->first()){
            $message = 'No order found with this tracking number.';

            return new JsonResponse(['error' => [
                'message' => $message,
                'feedback' => "<div class=\"invalid-feedback\">$message</div>",
            ]], 404);
        }

        $result = ['view' => view('themes.default.components.layouts.order-minimal', ['order' => $order])->render()];

        return $result;
    }
}
