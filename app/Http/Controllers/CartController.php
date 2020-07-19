<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function show()
    {
        return view('default.pages.cart');
    }

    public function showDelivery()
    {
        return view('default.pages.cart-delivery');
    }

    public function addDelivery(Request $request)
    {
        $cart = $request->session()->get('cart');
        $shippingAddressArray = $request->only('shipping')['shipping'];

        if (Address::validator($shippingAddressArray)->validate()) {
            $shippingAddress = Address::create($shippingAddressArray);
            $shippingAddress->save();
            $cart->shipping_address_id = $shippingAddress->id;
        }

        if (! isset($request['same_billing_address'])) {
            $billingAddressArray = $request->only('billing')['billing'];

            if (Address::validator($billingAddressArray)->validate()) {
                $billingAddress = Address::create($billingAddressArray);
                $billingAddress->save();
                $cart->billing_address_id = $billingAddress->id;
            }
        } else {
            $cart->billing_address_id = $shippingAddress->id;
        } 

        $cart->save();
        Cart::updateCartSession($request);

        return redirect(route('cart.payment'));
    } 

    public function showPayment()
    {
        return view('default.pages.cart-payment');
    }

    public function handlePayment(Request $request)
    {
        dd($request->only('payment'));
    }
}
