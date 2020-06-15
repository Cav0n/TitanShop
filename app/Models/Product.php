<?php

namespace App\Models;

use App\Models\Utils\CustomString;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Product extends Model
{
    public function i18ns()
    {
        return $this->hasMany('App\Models\ProductI18n');
    }

    public function images()
    {
        return $this->belongsToMany('App\Models\Image', 'product_image')->withPivot('position');;
    }

    public function setCodeAttribute($value)
    {
        if (null === $value) {
            $this->attributes['code'] = CustomString::prepareStringForURL($this->i18nValue('title'));
        } else {
            $this->attributes['code'] = CustomString::prepareStringForURL($value);
        }
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
