<?php

namespace App\Http\Controllers;

use App\Models\Administrator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdministratorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $administrators = Administrator::where('isDeleted', 0)->get();
        return view('default.pages.backoffice.administrators', ['administrators' => $administrators]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('default.pages.backoffice.administrator');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Administrator::validator($request->toArray())->validate();

        $administrator = new Administrator();

        $administrator->firstname = $request['firstname'];
        $administrator->lastname = $request['lastname'];
        $administrator->nickname = $request['nickname'];
        $administrator->email = $request['email'];
        $administrator->isActivated = $request['isActivated'] !== null;
        $administrator->password = Hash::make($request['password']);
        $administrator->save();

        return redirect(route('admin.administrator.edit', ['administrator' => $administrator]))->withSuccess('Le compte administrateur a été créé avec succés.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Administrator  $administrator
     * @return \Illuminate\Http\Response
     */
    public function show(Administrator $administrator)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Administrator  $administrator
     * @return \Illuminate\Http\Response
     */
    public function edit(Administrator $administrator)
    {
        return view('default.pages.backoffice.administrator', ['administrator' => $administrator]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Administrator  $administrator
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Administrator $administrator)
    {
        Administrator::validator($request->toArray(), $administrator)->validate();

        $administrator->firstname = $request['firstname'];
        $administrator->lastname = $request['lastname'];
        $administrator->nickname = $request['nickname'];
        $administrator->email = $request['email'];
        $administrator->isActivated = $request['isActivated'] !== null;

        if ($request['password'] !== null) {
            $administrator->password = Hash::make($request['password']);
        }

        $administrator->save();

        return redirect(route('admin.administrator.edit', ['administrator' => $administrator]))->withSuccess('Le compte administrateur a été mis à jour avec succés.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Administrator  $administrator
     * @return \Illuminate\Http\Response
     */
    public function destroy(Administrator $administrator)
    {
        $administrator->isActivated = 0;
        $administrator->isDeleted = 1;

        $administrator->save();
    }
}
