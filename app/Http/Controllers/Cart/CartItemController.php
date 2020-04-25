<?php

namespace App\Http\Controllers\Cart;

use App\CartItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        $cart = session('cart');
        $product = \App\ProductBase::where('id', $request['product_id'])->first();
        $quantity = $request['quantity'];

        if (null === $item = \App\CartItem::where('cart_id', $cart->id)->where('product_id', $product->id)->first()) {
            $item = new CartItem();
        }

        $item->quantity += $quantity ?? 1;
        $item->product_id = $product->id;
        $item->cart_id = $cart->id;

        $item->save();

        if ($item->quantity > $product->stock) {
            $item->quantity = $product->stock;
            $item->save();
        }

        return redirect(route('cart.item.added', ['item' => $item]));
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

    /**
     * Show "product added to cart" page
     *
     * @return void
     */
    public function notificationPage(Request $request, CartItem $item)
    {
        return view('themes.default.pages.public.product-added-to-cart', ['item' => $item]);
    }
}
