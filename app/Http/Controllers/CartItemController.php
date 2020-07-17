<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CartItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $productId = $request['product_id'];
        $quantity = $request['quantity'];

        if (isset($request['cart_id'])) {
            $cartId = $request['cart_id'];
        } else {
            $cartId = $request->session()->get('cart')->id;
        }

        if (null !== $item = CartItem::where('cart_id', $cartId)->where('product_id', $productId)->first()) {
            $item->quantity += $quantity;
            $item->save();
            Cart::updateCartSession($request);
            return JsonResponse::create(['success' => 'Cart item updated successfully.']);
        }

        $item = new CartItem();
        $item->cart_id = $cartId;
        $item->product_id = $productId;
        $item->quantity = $quantity;
        $item->save();
        Cart::updateCartSession($request);
        return JsonResponse::create(['success' => 'Cart item created successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CartItem  $cartItem
     * @return \Illuminate\Http\Response
     */
    public function show(CartItem $cartItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CartItem  $cartItem
     * @return \Illuminate\Http\Response
     */
    public function edit(CartItem $cartItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CartItem  $cartItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CartItem $cartItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CartItem  $cartItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(CartItem $cartItem)
    {
        //
    }
}
