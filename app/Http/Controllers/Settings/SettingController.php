<?php

namespace App\Http\Controllers\Settings;

use App\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SettingI18n;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = Setting::where('isEditable', 1)->get();

        return view('themes.default.pages.admin.settings')->with(['settings' => $settings]);
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
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource or create it if it doesn't exists.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateOrCreate(Request $request)
    {
        foreach ($request->input('settings') as $settingCode => $value) {
            $setting = Setting::firstOrNew(['code' => $settingCode]);
            $setting->value = $value;
            $setting->type = 'string';
            $setting->save();
        }

        return redirect()->back()->with(['success' => ['Les paramètres ont été modifié avec succés.']]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }

    /**
     * This is called during installation process.
     *
     * @return bool
     */
    public function install()
    {
        $path = \base_path() . "/config/install/settings.json";

        $json = json_decode(file_get_contents($path), true);

        foreach ($json['settings'] as $value) {
            $setting = new Setting();

            $setting->code = $value['code'];
            $setting->type = $value['type'];
            $setting->isEditable = $value['isEditable'];
            $setting->save();

            if (isset($value['value'])) {
                $setting->value = $value['value'];
            }

            if (isset($value['i18n'])) {
                foreach ($value['i18n'] as $valueI18n) {
                    $settingI18n = new SettingI18n();

                    $settingI18n->setting_id = $setting->id;
                    $settingI18n->lang = $valueI18n['lang'];
                    $settingI18n->title = $valueI18n['title'];
                    $settingI18n->save();

                    if (isset($valueI18n['help'])) {
                        $settingI18n->help = $valueI18n['help'];
                        $settingI18n->save();
                    }
                }
            }
        }

        return true;
    }
}
