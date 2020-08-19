<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Setting extends Model
{
    public function i18ns()
    {
        return $this->hasMany('App\Models\SettingI18n');
    }

    public function settingGroup()
    {
        return $this->belongsTo('App\Models\SettingGroup');
    }

    public function i18nValue($valueName, $lang = null)
    {
        if (!isset($lang)) {
            $lang = App::getLocale();
        }

        $i18n = $this->i18ns()->where('lang', $lang)->first();

        return $i18n->$valueName;
    }

    public function generateInput()
    {
        switch ($this->type) {
            case 'string' :
                return '<input type="text" name="'.$this->code.'" class="form-control" id="'.$this->code.'" value="'.$this->value.'">';
            break;
        }
    }
}
