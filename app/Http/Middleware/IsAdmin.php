<?php

namespace App\Http\Middleware;

use App\Admin;
use Closure;

class IsAdmin
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
            return $next($request);
        }

        return redirect(route('admin.login'));
    }
}
