<?php

namespace App\Http\Controllers\Cart;

use App\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function addAddresses(Request $request)
    {
        $cart = session('cart');
        $shippingAddress = app('App\Http\Controllers\AddressController')->store($request['shipping']);

        if (isset($request['sameBillingAddress']) && $request['sameBillingAddress']) {
            $billingAddress = $shippingAddress;
        } else {
            $billingAddress = app('App\Http\Controllers\AddressController')->store($request['billing']);
        }

        $cart->shipping_address_id = $shippingAddress->id;
        $cart->billing_address_id = $billingAddress->id;
        $cart->save();

        return redirect()->route('cart.payment');
    }

    public function doPayment(Request $request)
    {
        $paymentMethod = $request['payment_method'];

        switch ($paymentMethod) {
            case 'cheque':
                return redirect(route('cart.payment.cheque'));

            default:
                return back()->withErrors(['payment_method' => "The payment method \"$paymentMethod\" is not valid"]);
        }
    }

    public function chequeInstructions()
    {
        $cart = session('cart');

        return view('themes.default.pages.public.cart-cheque-payment')->with(['cart' => $cart]);
    }
}
