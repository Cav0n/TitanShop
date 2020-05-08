<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    /**
     * Show login page
     */
    public function show()
    {
        return view('themes.default.pages.customer-area.login');
    }

    /**
     * Handle login
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email:filter|exists:users',
            'password' => 'required|min:8'
        ]);

        $credentials = $request->only('email', 'password');

        if (! \App\User::where('email', $credentials['email'])->first()->isActivated) {
            return back()->withErrors(['login' => 'Votre compte n\'est pas activé.'])
                    ->withInput();
        }

        if (Auth::attempt($credentials)) {
            return redirect()->intended(route('customer-area.index'));
        }

        return \back();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->forget('cart');

        return redirect()->route('index');
    }
}
