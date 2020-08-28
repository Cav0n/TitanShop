<?php

namespace App\Http\Middleware;

use Closure;
use \Illuminate\Http\Request;

class IsCustomerConnected
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (! \App\Models\Customer::check($request)) {
            return redirect(route('customer-area.login.show'));
        }

        return $next($request);
    }
}
