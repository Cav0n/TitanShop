<?php

namespace App\Http\Middleware;

use Closure;
use \App\Cart;
use Illuminate\Support\Facades\Auth;

class CheckCart
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (! session()->has('cart')) {
            $this->createCart();
        } else {
            session(['cart' => Cart::where('token', session('cart')->token)->first()]);

            try {
                session('cart')->items;
            } catch (\Throwable $th) {
                $this->createCart();
            }
        }

        return $next($request);
    }

    protected function createCart()
    {
        $cart = new Cart();
        $cart->user_id = Auth::check() ? Auth::user()->id : null;
        $cart->generateToken();
        $cart->save();

        session(['cart' => $cart]);
    }
}
