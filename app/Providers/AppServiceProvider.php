<?php

namespace App\Providers;

use App\Hook;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    const VIEW_PREFIX = 'themes.default.';

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('active', function ($routeName) {
            if ( (null !== Request::route()) && (Request::route()->named($routeName)) ) {
                return 'active';
            }
        });

        Blade::if('isAdmin', function () {
            return \App\Admin::check();
        });

        Blade::include('themes.default.components.hook', 'hook');
    }
}
