<?php

namespace App\Http\Middleware;

use App\Admin;
use Closure;

class IsNotAdmin
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
        if (null !== session('admin') && Admin::check()) {
            return redirect(route('admin'));
        }

        return $next($request);
    }
}
