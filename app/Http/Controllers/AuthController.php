<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Administrator;
use App\Models\Cart;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showCustomerRegisterPage()
    {
        return view('default.pages.customer-area.register');
    }

    public function customerRegister(Request $request)
    {
        $customer = new Customer();
        $customer->firstname = $request['firstname'];
        $customer->lastname = $request['lastname'];
        $customer->email = $request['email'];
        $customer->phone = $request['phone'];
        $customer->password = Hash::make($request['password']);
        $customer->lang = $request['lang'] ?? 'fr';
        $customer->isActivated = $request['isActivated'] ?? true;
        try {
            $customer->save();
        } catch (Exception $e) {
            return $this->redirectBackWithError(null, 'Une erreur est survenu lors de la création de votre compte.');
        }

        $request->session()->put('customer_id', $customer->id);
        $request->session()->put('customer_hash', Hash::make($customer->email . $customer->password));

        Cart::addCustomerToCartSession($request, $customer);

        return redirect(route('customer-area.homepage'));
    }

    public function showCustomerLoginPage()
    {
        return view('default.pages.customer-area.login');
    }

    public function customerLogin(Request $request)
    {
        $email = $request['email'];
        $password = $request['password'];

        if (null === $customer = Customer::where('email', $email)->first()) {
            return $this->redirectBackWithError();
        }

        if (! $customer->isActivated) {
            return $this->redirectBackWithError('login', 'Votre compte a été supprimé ou désactivé.');
        }

        if (! Hash::check($password, $customer->password)) {
            return $this->redirectBackWithError();
        }

        $request->session()->put('customer_id', $customer->id);
        $request->session()->put('customer_hash', Hash::make($customer->email . $customer->password));

        Cart::addCustomerToCartSession($request, $customer);

        return redirect(route('customer-area.homepage'));
    }

    public function customerLogout(Request $request)
    {
        $request->session()->forget('customer_id');
        $request->session()->forget('customer_hash');

        return redirect(route('homepage'));
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

        $request->session()->put('admin_id', $admin->id);
        $request->session()->put('admin_token', $admin->generateSessionToken());

        return redirect(route('admin.homepage'));
    }

    public function adminLogout(Request $request)
    {
        $request->session()->forget('admin_id');
        $request->session()->forget('admin_token');

        return redirect(route('homepage'));
    }

    protected function redirectBackWithError($inputName = null, $error = 'Aucun compte n\'existe avec ces identifiants')
    {
        return back()
            ->withErrors($inputName !== null ? [$inputName => $error] : $error)
            ->withInput();
    }
}
