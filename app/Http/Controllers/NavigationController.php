<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NavigationController extends Controller
{
    public function showHomepage()
    {
        return view('default.pages.homepage');
    }

    public function showCart()
    {
        return view('default.pages.cart');
    }
}
