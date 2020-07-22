<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function show(Request $request)
    {
        $cart = $request->session()->get('cart');
        $cart->step = Cart::CART_STEP_HOME;
        $cart->save();
        Cart::updateCartSession($request);

        return view('default.pages.cart');
    }

    public function showDelivery(Request $request)
    {
        if (! Cart::check($request)) {
            return redirect(route('cart'));
        }

        $cart = $request->session()->get('cart');
        $cart->step = Cart::CART_STEP_DELIVERY;
        $cart->save();
        Cart::updateCartSession($request);

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

        $cart->step = Cart::CART_STEP_PAYMENT;

        $cart->save();
        Cart::updateCartSession($request);

        return redirect(route('cart.payment'));
    }

    public function showPayment(Request $request)
    {
        if (! Cart::check($request) || $request->session()->get('cart')->step !== Cart::CART_STEP_PAYMENT) {
            return redirect(route('cart'));
        }

        return view('default.pages.cart-payment');
    }

    public function handlePayment(Request $request)
    {
        // TODO : validate email / payment method

        if (! Cart::check($request) || $request->session()->get('cart')->step !== Cart::CART_STEP_PAYMENT) {
            return redirect(route('cart'));
        }

        $cart = $request->session()->get('cart');
        $cart->email = $request['email'];
        $cart->phone = $request['phone'];
        $cart->paymentMethod = $request['payment'];
        $cart->save();
        Cart::updateCartSession($request);

        return redirect(route(''));
    }
}
