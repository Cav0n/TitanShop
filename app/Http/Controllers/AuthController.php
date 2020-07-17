<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Administrator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showCustomerRegisterPage()
    {
        return view('default.pages.customer-area-login');
    }

    public function customerRegister(Request $request)
    {
        
    } 

    public function showCustomerLoginPage()
    {

    }

    public function customerLogin(Request $request)
    {
        return $this->redirectBackWithError();
    }

    public function showAdminLoginPage()
    {
        return view('default.pages.backoffice.login');
    }

    public function adminLogin(Request $request)
    {
        $login = $request['login'];
        $password = $request['password'];

        if (! Administrator::where('email', $login)->orWhere('nickname', $login)->exists()) {
            return $this->redirectBackWithError();
        }

        $admin = Administrator::where('email', $login)->orWhere('nickname', $login)->first();

        if (! Hash::check($password, $admin->password)) {
            return $this->redirectBackWithError();
        }

        $id = $admin->id;
        $token = $admin->generateSessionToken();

        $request->session()->put('admin_id', $id);
        $request->session()->put('admin_token', $token);

        return redirect(route('admin.homepage'));
    }

    protected function redirectBackWithError($inputName = 'login', $error = 'Aucun compte n\'existe avec ces identifiants')
    {
        return back()
            ->withErrors([$inputName => $error])
            ->withInput();
    }
}
