<?php

namespace App\Http\Controllers;

use App\Events\Order\OrderPlacedEvent;
use App\Models\Cart;
use App\Models\Customer;
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

        if (Customer::check($request)) {
            $order->customer_id = $request->session()->get('customer_id');
            $order->save();
        }

        event(new OrderPlacedEvent($order));

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

    public function updateStatus(Request $request, Order $order)
    {
        if (! isset($request['new_status_id'])) {
            return new JsonResponse(['status' => 'error', 'message' => 'The new status ID is missing.'], 500);
        }

        if (null === $status = OrderStatus::where('id', $request['new_status_id'])->first()) {
            return new JsonResponse(['status' => 'error', 'message' => 'The selected status doesn\'t exists.'], 404);
        }

        $order->order_status_id = $status->id;
        $order->save();

        return new JsonResponse([
            'status' => 'success',
            'message' => 'Order status updated successfully',
            'order_status' => [
                'id' => $status->id,
                'code' => $status->code,
                'title' => $status->i18nValue('title'),
                'badge' => $status->generateBadge()
            ]
        ], 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, OrderStatus $status = null)
    {
        $data = [];
        $orders = Order::orderBy('created_at', 'DESC');

        if (isset($status)) {
            $orders = $orders->where('order_status_id', $status->id);
            $data['status'] = $status;
        }

        $data['orders'] = $orders->get();

        return view('default.pages.backoffice.orders', $data);
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
