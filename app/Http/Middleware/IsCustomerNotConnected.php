<?php

namespace App\Http\Middleware;

use Closure;
use \Illuminate\Http\Request;

class IsCustomerNotConnected
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
            return $next($request);
        }

        return redirect(route('customer-area.homepage'));
    }
}
