<?php

namespace App\Http\Controllers\Users;

use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $administrators = Admin::all();

        return view('themes.default.pages.admin.users.administrators')->with(['administrators' => $administrators]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('themes.default.pages.admin.users.administrator');
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

        $administrator = new Admin();
        $administrator->firstname = ucfirst($request['firstname']);
        $administrator->lastname = ucfirst($request['lastname']);
        $administrator->pseudo = strtolower($request['pseudo']);
        $administrator->email = strtolower($request['email']);
        $administrator->password = Hash::make($request['password']);
        $administrator->role = $request['role'];
        $administrator->save();

        if(isset($request['next_url'])) {
            if (route('install.success') === $request['next_url']) {
                $token = Str::random(60);
                $administrator->token = Hash::make($token);
                $administrator->save();
                $administrator->token = $token;
                session(['admin' => $administrator]);
            }

            return redirect($request['next_url']);
        }

        return redirect(route('admin.users.administrator.edit', ['administrator' => $administrator]));
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
     * @param  \App\Admin  $administrator
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $administrator)
    {
        return view('themes.default.pages.admin.users.administrator')->with(['administrator' => $administrator]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $administrator)
    {
        $this->validator($request, $administrator)->validate();

        $administrator->firstname = ucfirst($request['firstname']);
        $administrator->lastname = ucfirst($request['lastname']);
        $administrator->pseudo = strtolower($request['pseudo']);
        $administrator->email = strtolower($request['email']);
        $administrator->role = $request['role'];
        $administrator->isActivated = $request['isActivated'] ? 1 : 0;
        $administrator->save();

        if (null !== $request['password']) {
            $administrator->password = Hash::make($request['password']);
            $administrator->save();
        }

        return redirect(route('admin.users.administrator.edit', ['administrator' => $administrator]));
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

    /**
     * Administrator informations validator
     *
     * @param  mixed $request
     * @param  mixed $administrator
     * @return void
     */
    protected function validator(Request $request, $administrator = null)
    {
        $uniqueRule = isset($administrator) ? Rule::unique('admins')->ignore($administrator->id) : Rule::unique('admins');
        $roleRule = Rule::in(Admin::ROLES);

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
                $uniqueRule
            ],
            'pseudo' => [
                'required',
                'min:3',
                $uniqueRule
            ],
            'role' => [
                'required',
                $roleRule
            ],
            'password' => [
                'nullable',
                'confirmed',
                'min:8'
            ]
        ));
    }
}
