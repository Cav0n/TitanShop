<?php

namespace App;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

class Utils
{
    /**
     * Return $output ('active' by default) if current route correspond.
     *
     * @param string        $routeName The route name
     * @param array|null    $parameters Some parameters to check
     * @param string|null   $output The output ('active' by default)
     *
     * @return string|null
     */
    public static function active(string $routeName, $parameters = null, $output = 'active')
    {
        $routePrefix = str_replace('/', '',Request::route()->getPrefix());

        /**
         * Check if routeName is equal to current route name
         * or if routeName prefix is equal to current route name prefix
         */
        if ((null !== Request::route())
                && (Request::route()->named($routeName)
                || ('' !== $routePrefix && false !== strpos($routeName, $routePrefix)) )) {

                    /**
                     * All parameters of the current request are equal to $parameters
                     */
                    if (isset($parameters) && \is_array($parameters)) {
                        if (! (route($routeName, $parameters) === url()->full())) {
                            return;
                        }
                    }

            return $output;
        }

        return;
    }
}
