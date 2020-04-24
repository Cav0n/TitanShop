<?php

namespace App\Http\Middleware;

use Closure;
use \App\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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
            $cart = new Cart();
            $cart->token = Str::random(15);
            $cart->user_id = Auth::check() ? Auth::user()->id : null;
            $cart->save();

            session(['cart' => $cart]);
        } else {
            session(['cart' => Cart::where('token', session('cart')->token)->first()]);
        }

        return $next($request);
    }
}
