<?php

namespace App\Http\Controllers\Main;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Settings\SettingController;
use Exception;

class InstallController extends Controller
{
    public function install()
    {
        return redirect(route('install.database'));
    }

    public function databaseStep()
    {
        return view('themes.default.tmp.install.database');
    }

    public function databaseUpdate(Request $request)
    {
        copy(base_path() . '/.env', base_path() . '/.env.backup');

        MainController::changeEnv([
            'DB_HOST' => $request['base_address'],
            'DB_PORT' => $request['base_port'] ?? 3306,
            'DB_DATABASE' => $request['base_name'],
            'DB_USERNAME' => $request['base_login'],
            'DB_PASSWORD' => $request['base_password'],
        ]);

        try {
            Artisan::call('migrate:refresh', ['--quiet' => true]);
        } catch (\Exception $e) {
            return back()
                    ->withErrors('<b>Erreur lors de l\'ajout de la base de donnée.</b><br>Erreur: ' . $e->getMessage())
                    ->withInput();
        }

        return redirect(route('install.informations'));
    }

    public function informationsStep()
    {
        return view('themes.default.tmp.install.informations');
    }

    public function informationsUpdate(Request $request)
    {
        try {
            (new SettingController)->updateOrCreate($request);
        } catch (Exception $e) {
            return back()
                    ->withErrors('<b>Erreur lors de l\'ajout des informations.</b><br>Erreur: ' . $e->getMessage())
                    ->withInput();
        }

        return redirect(route('install.admin'));
    }

    public function adminStep()
    {
        return view('themes.default.tmp.install.admin');
    }

    public function success()
    {
        return view('themes.default.tmp.install.success');
    }
}
