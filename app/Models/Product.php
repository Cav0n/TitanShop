<?php

namespace App\Models;

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
        return $this->belongsToMany('App\Models\Image');
    }

    public function i18nValue($valueName, $lang = null)
    {
        if (!isset($lang)) {
            $lang = App::getLocale();
        }

        $i18n = $this->i18ns()->where('lang', $lang)->first();

        return $i18n->$valueName;
    }

    public static function generateCode($title, $sep = '-')
    {
        $title = self::stripAccents($title);
        $title = strtolower($title);
        $title = preg_replace('/[^[:alnum:]]/', '', $title);
        $title = preg_replace('/[[:space:]]+/', $sep, $title);
        return $title;

    }

    private static function stripAccents($stripAccents){
        return strtr($stripAccents,'àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ','aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');
    }
}
