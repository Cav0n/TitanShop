<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Closure;

class ShopIsInstalled
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
            return abort(404);
        }

        if (Schema::hasTable('settings')) {
            if (false == \App\Setting::valueOrNull("SHOP_ACTIVATED")) {
                return abort(404);
            }
        } else {
            return abort(404);
        }

        return $next($request);
    }
}
