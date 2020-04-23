<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\User;

class RegisterController extends Controller
{
    /**
     * Show registration page
     */
    public function show()
    {
        return view('themes.default.pages.customer-area.register');
    }

    /**
     * Handle registration
     */
    public function register(Request $request)
    {
        $request->validate([
            'firstname' => 'required|min:3',
            'lastname' => 'required|min:3',
            'phone' => 'nullable|min:10',
            'email' => 'required|email:filter|unique:users',
            'password' => 'required|min:8'
        ]);

        $user = new User();
        $user->firstname = $request['firstname'];
        $user->lastname = $request['lastname'];
        $user->phone = $request['phone'];
        $user->email = $request['email'];
        $user->password = $request['password'];
        $user->save();
    }
}
