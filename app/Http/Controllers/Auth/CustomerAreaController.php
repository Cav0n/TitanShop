<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class CustomerAreaController extends Controller
{
    /**
     * Show login page
     *
     * @return void
     */
    public function show()
    {
        return view('themes.default.pages.customer-area.index');
    }
}
