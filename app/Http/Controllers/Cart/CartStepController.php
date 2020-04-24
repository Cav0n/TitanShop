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

        return view('themes.default.pages.public.cart-delivery')->with(['cart' => $cart]);
    }

    /**
     * Display payment step
     *
     * @return void
     */
    public function showPayment()
    {
        //
    }
}
