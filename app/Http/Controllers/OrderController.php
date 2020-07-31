<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderStatus;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    // TODO: HAS TO BE DONE IN AN EVENT
    public function createFromCart(Request $request)
    {
        $cart = $request->session()->get('cart');

        $order = new Order([], $cart);
        $order->order_status_id = $request['status_id'] ?? OrderStatus::where('code', 'WAITING_PAYMENT')->first()->id;
        $order->save();

        foreach ($cart->items as $cartItem) {
            $orderItem = new OrderItem(null, $cartItem, $order);
            $orderItem->save();

            $cartItem->product->stock -= $cartItem->quantity;
            $cartItem->product->save();
        }

        Cart::generateNewCartSession($request);

        return redirect(route('cart.thanks'));
    }

    public function track(Request $request)
    {
        if (null === $order = Order::where('token', $request['trackingNumber'])->first()) {
            return new JsonResponse([
                'status' => 'error',
                'message' => 'No order with this tracking number.'
            ], 404);
        }

        if (!isset($request['email']) || strtoupper($order->email) !== strtoupper($request['email'])) {
            return new JsonResponse([
                'status' => 'success',
                'message' => 'An order has been found with this tracking number, but email is missing or incorrect.',
                'order' => [
                    'status'    => $order->status->generateBadge(),
                    'date'      => $order->created_at->format('d/m/Y')
                ]
            ], 200);
        }

        return new JsonResponse([
            'status' => 'success',
            'message' => 'An order has been found with this tracking number.',
            'order' => [
                'status'    => $order->status->generateBadge(),
                'date'      => $order->created_at->format('d/m/Y'),
                'price'     => $order->totalPriceFormatted
            ]
        ], 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::orderBy('created_at', 'DESC')->get();

        return view('default.pages.backoffice.orders', ['orders' => $orders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        return view('default.pages.backoffice.order', ['order' => $order]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
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
