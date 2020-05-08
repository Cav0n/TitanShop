<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {

        $request->validate([
            'login' => 'required',
            'password' => 'required',
        ]);

        if (null !== $admin = Admin::where('email', $request['login'])->orWhere('pseudo', $request['login'])->first()) {
            if (! $admin->isActivated) {
                return back()->withErrors(['login' => 'Votre compte est désactivé. Veuillez contacter l\'administrateur du site.'])
                            ->withInput();
            }

            if (Hash::check($request['password'], $admin->password)) {
                $token = Str::random(60);
                $admin->token = Hash::make($token);
                $admin->save();
                $admin->token = $token;
                session(['admin' => $admin]);

                return redirect('/admin');
            }
        }

        return back()->withErrors(['login' => 'Ces informations ne correspondent a aucun compte.'])
                    ->withInput();
    }

    public function logout()
    {
        session()->forget('admin');
        return redirect(route('index'));
    }

    public function showLoginPage()
    {
        return view('themes.default.pages.admin.login');
    }
}
