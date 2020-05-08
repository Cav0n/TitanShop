<?php

namespace App\Http\Controllers\Users;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Mail\UserRegistered;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = User::all();

        return view('themes.default.pages.admin.users.customers')->with(['customers' => $customers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('themes.default.pages.admin.users.customer');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validator($request)->validate();

        $customer = new User();
        $customer->firstname = ucfirst($request['firstname']);
        $customer->lastname = ucfirst($request['lastname']);
        $customer->email = strtolower($request['email']);
        $customer->phone = $request['phone'];
        $customer->password = Hash::make($request['password']);
        $customer->save();

        if (isset($request['backoffice_redirect'])) {
            return redirect(route('admin.users.customer.edit', ['customer' => $customer]));
        }

        try {
            Mail::to($customer->email)->send(
                new UserRegistered($customer));
        } catch (Exception $e) {
            throw $e;
        }

        return redirect()->back()->with(['success' => ['Votre compte a été créé avec succés.']]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $customer)
    {
        return view('themes.default.pages.admin.users.customer', ['customer' => $customer]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $customer = null)
    {
        $customer = $customer ?? Auth::user();
        $this->validator($request, $customer)->validate();

        $customer->firstname = ucfirst($request['firstname']);
        $customer->lastname = ucfirst($request['lastname']);
        $customer->email = strtolower($request['email']);
        $customer->phone = $request['phone'];
        $customer->isActivated = $request['isActivated'] ? 1 : 0;
        $customer->save();

        $successMessage = "Vos informations ont bien été mis à jour.";

        if (isset($request['backoffice_redirect'])) {
            $successMessage = "Les informations du client ont été modifiées avec succés.";
        }

        return redirect()->back()->with(['success' => [$successMessage]]);
    }

    /**
     * Updated user's password
     *
     * @param  mixed $request
     * @return void
     */
    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $this->passwordValidator($request)->validate();

        if (Hash::check($request['old-password'], $user->password)){
            $user->password = Hash::make($request['password']);
            $user->save();

            return redirect()->back()->with(['success' => ['Votre mot de passe a bien été mis à jour.']]);
        }

        return redirect()->back()->withErrors(['old-password' => 'Mot de passe actuel incorrect.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    /**
     * User informations validator
     *
     * @param  mixed $request
     * @param  mixed $user
     * @return void
     */
    protected function validator(Request $request, $user = null)
    {
        $uniqueEmailRule = isset($user) ? Rule::unique('users')->ignore($user->id) : Rule::unique('users');

        return Validator::make($request->all(), array(
            'firstname' => [
                'required',
                'min:2'
            ],
            'lastname' => [
                'required',
                'min:2'
            ],
            'email' => [
                'required',
                'email:filter',
                $uniqueEmailRule
            ],
            'phone' => [
                'nullable',
                'min:10'
            ]
        ));
    }

    /**
     * Password modification request validator
     *
     * @param  mixed $request
     * @return void
     */
    public function passwordValidator(Request $request)
    {
        return Validator::make($request->all(), array(
            'old-password' => [
                'required',
                'min:8'
            ],
            'password' => [
                'required',
                'min:8',
                'confirmed'
            ]
        ));
    }
}
