<?php

namespace App\Http\Middleware;

use App\Models\Cart;
use Closure;

class CheckCartValidity
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
        if (! Cart::check($request)) {
            Cart::generateNewCartSession($request);
        }

        return $next($request);
    }
}
