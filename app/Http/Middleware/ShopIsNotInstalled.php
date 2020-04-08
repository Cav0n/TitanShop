<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Closure;

class ShopIsNotInstalled
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
        try {
            DB::connection()->getPdo();
        } catch (\Exception $e) {
            return $next($request);
        }

        if (Schema::hasTable('settings')) {
            if (true == \App\Setting::valueOrNull("SHOP_ACTIVATED")) {
                abort(404);
            }
        }

        return $next($request);
    }
}
