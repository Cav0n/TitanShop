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
}
