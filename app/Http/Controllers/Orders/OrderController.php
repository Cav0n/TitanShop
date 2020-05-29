<?php

namespace App\Http\Controllers\Orders;

use App\Cart;
use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\Admin\OrderCreated as AdminOrderCreated;
use App\Mail\OrderCreated;
use App\Mail\OrderStatusUpdated;
use App\OrderItem;
use Exception;
use Illuminate\Support\Facades\Log;
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
        $orders = Order::orderBy('created_at', 'desc')->get();
        return view('themes.default.pages.admin.orders')->with(['orders' => $orders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $orderStatus = \App\OrderStatus::all();

        return view('themes.default.pages.admin.order', ['orderStatus' => $orderStatus]);
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
        $order->email = $cart->email;
        $order->phone = $cart->phone;
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
            Mail::to($order->email)->send(new OrderCreated($order));
            Mail::to(\App\Setting::valueOrNull('SHOP_EMAIL'))->send(new AdminOrderCreated($order));
        } catch (Exception $e) {
            Log::alert('MAIL ERROR : ' . $e->getMessage());
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
        $orderStatus = \App\OrderStatus::all();

        return view('themes.default.pages.admin.order', ['order' => $order, 'orderStatus' => $orderStatus]);
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
     * Update the order's status
     *
     * @return void
     */
    public function updateStatus(Request $request, Order $order)
    {
        $order->status_id = \App\OrderStatus::where('code', $request['statusCode'])->first()->id;
        $order->save();

        try {
            Mail::to($order->email)->send(new OrderStatusUpdated($order));
        } catch (Exception $e) {
            Log::alert('MAIL ERROR : ' . $e->getMessage());
        }

        return response()->json([
            'message' => 'Le statut de la commande a été mis à jour avec succés.',
            'color' => $order->status->color
        ]);
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
        $trackingNumber = ltrim(trim($request['t']), '#');

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
