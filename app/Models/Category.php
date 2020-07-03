<?php

namespace App\Models;

use App\Models\Utils\CustomString;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Category extends Model
{
    public function i18ns()
    {
        return $this->hasMany('App\Models\CategoryI18n');
    }

    public function images()
    {
        return $this->belongsToMany('App\Models\Image', 'category_image')->withPivot('position');;
    }

    public function products()
    {
        return $this->belongsToMany('App\Models\Product');
    } 

    public function i18nValue($valueName, $lang = null)
    {
        if (!$this->i18ns()->exists()) {
            return null;
        }

        if (!isset($lang)) {
            $lang = App::getLocale();
        }

        if (null === $i18n = $this->i18ns()->where('lang', $lang)->first()) {
            $i18n = $this->i18ns()->where('lang', App::getLocale())->first();
        }

        if (null === $i18n) {
            return $this->i18ns()->first()->$valueName;
        }

        return $i18n->$valueName;
    }
}
