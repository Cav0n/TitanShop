<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;

class Image extends Model
{
    public function i18ns()
    {
        return $this->hasMany('App\Models\ImageI18n');
    }

    public function i18nValue($valueName, $lang = null)
    {
        if (!isset($lang)) {
            $lang = App::getLocale();
        }

        $i18n = $this->i18ns()->where('lang', $lang)->first();

        return $i18n->$valueName;
    }

    public static function validator(array $data)
    {
        return Validator::make($data, [
            'path' => 'required|min:2|max:255',
        ]);
    }

    public function storeValues(array $values)
    {
        $this->path = $values['path'];

        $this->save();
    }
}
