<?php

namespace App\Http\Controllers;

use App\Models\SettingGroup;
use Illuminate\Http\Request;

class SettingGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settingGroups = SettingGroup::all();

        return view('default.pages.backoffice.settings', ['settingGroups' => $settingGroups]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SettingGroup  $settingGroup
     * @return \Illuminate\Http\Response
     */
    public function show(SettingGroup $settingGroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SettingGroup  $settingGroup
     * @return \Illuminate\Http\Response
     */
    public function edit(SettingGroup $settingGroup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SettingGroup  $settingGroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SettingGroup $settingGroup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SettingGroup  $settingGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(SettingGroup $settingGroup)
    {
        //
    }
}
