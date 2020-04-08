<?php

namespace App\Http\Controllers\Users;

use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class AdminController extends Controller
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
        $request->validate([
            'firstname' => 'required|min:2',
            'lastname' => 'required|min:2',
            'pseudo' => 'required|unique:admins|min:5',
            'email' => 'required|unique:admins|email:rfc,dns',
            'password' => 'required|confirmed|min:8',
            'role' => 'required'
        ]);

        $admin = new Admin();
        $admin->firstname = ucfirst($request['firstname']);
        $admin->lastname = ucfirst($request['lastname']);
        $admin->pseudo = strtolower($request['pseudo']);
        $admin->email = strtolower($request['email']);
        $admin->password = Hash::make($request['password']);
        $admin->role = $request['role'];
        $admin->save();

        if(isset($request['next_url'])) {
            return redirect($request['next_url']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        //
    }
}
