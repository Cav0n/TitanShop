<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Mail\UserRegistered;
use App\User;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

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
        $user->password = Hash::make($request['password']);;
        $user->save();

        try {
            Mail::to($user->email)->send(
                new UserRegistered($user));
        } catch (Exception $e) {
            Log::alert('MAIL ERROR : ' . $e->getMessage());
        }

        return redirect(route('customer-area.index', ['success' => ['Votre compte a été créé avec succés.']]));
    }
}
