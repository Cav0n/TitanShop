<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class SettingGroup extends Model
{
    public function i18ns()
    {
        return $this->hasMany('App\Models\SettingGroupI18n');
    }

    public function settings()
    {
        return $this->hasMany('App\Models\Setting');
    }

    public function i18nValue($valueName, $lang = null)
    {
        if (!isset($lang)) {
            $lang = App::getLocale();
        }

        $i18n = $this->i18ns()->where('lang', $lang)->first();

        return $i18n->$valueName;
    }
}
