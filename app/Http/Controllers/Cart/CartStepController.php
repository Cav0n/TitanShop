<?php

namespace App\Http\Controllers\Cart;

use App\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartStepController extends Controller
{
    /**
     * Display current cart
     *
     * @return void
     */
    public function showCurrent()
    {
        $cart = session('cart');

        return view('themes.default.pages.public.cart')->with(['cart' => $cart]);
    }

    /**
     * Display delivery step
     *
     * @return void
     */
    public function showDelivery()
    {
        $cart = session('cart');

        if (0 < count($cart->items)) {
            return view('themes.default.pages.public.cart-delivery')->with(['cart' => $cart]);
        }

        return redirect(route('cart'));
    }

    /**
     * Display payment step
     *
     * @return void
     */
    public function showPayment()
    {
        $cart = session('cart');

        if (isset($cart->shippingAddress) && isset($cart->billingAddress)) {
            return view('themes.default.pages.public.cart-payment')->with(['cart' => $cart]);
        }

        return redirect(route('cart.delivery'));
    }

    /**
     * Show thanks page
     *
     * @param  \App\Order $order
     * @return void
     */
    public function showThanks(\App\Order $order)
    {
        return view('themes.default.pages.public.cart-thanks')->with(['order' => $order]);
    }
}
