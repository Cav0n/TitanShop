<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Main\MainController;
use \Illuminate\Http\Request;
use Artisan;

class SettingsController extends Controller
{
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

        echo "Base ajoutée !";
    }
}
