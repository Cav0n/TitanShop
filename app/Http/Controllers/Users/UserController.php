<?php

namespace App\Http\Controllers\Users;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

        $user = new User();
        $user->firstname = ucfirst($request['firstname']);
        $user->lastname = ucfirst($request['lastname']);
        $user->email = strtolower($request['email']);
        $user->phone = $request['phone'];
        $user->save();

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
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        $this->validator($request, $user)->validate();

        $user->firstname = ucfirst($request['firstname']);
        $user->lastname = ucfirst($request['lastname']);
        $user->email = strtolower($request['email']);
        $user->phone = $request['phone'];
        $user->save();

        return redirect()->back()->with(['success' => ['Vos informations ont bien été mis à jour.']]);
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
