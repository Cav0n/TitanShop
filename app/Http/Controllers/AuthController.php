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
        return view('default.pages.customer-area.login');
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

        if (null === $admin = Administrator::where('email', $login)->orWhere('nickname', $login)->first()) {
            return $this->redirectBackWithError();
        }

        if (!$admin->isActivated || $admin->isDeleted) {
            return $this->redirectBackWithError('login', 'Votre compte a été supprimé ou désactivé.');
        }

        if (! Hash::check($password, $admin->password)) {
            return $this->redirectBackWithError();
        }

        $id = $admin->id;
        $token = $admin->generateSessionToken();

        $request->session()->put('admin_id', $id);
        $request->session()->put('admin_token', $token);

        return redirect(route('admin.homepage'));
    }

    public function adminLogout(Request $request)
    {
        $request->session()->forget('admin_id');
        $request->session()->forget('admin_token');

        return redirect(route('homepage'));
    }

    protected function redirectBackWithError($inputName = 'login', $error = 'Aucun compte n\'existe avec ces identifiants')
    {
        return back()
            ->withErrors([$inputName => $error])
            ->withInput();
    }
}
