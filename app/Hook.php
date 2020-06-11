<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hook extends Model
{
    public static function getViews(string $code)
    {
        $views = Hook::where('code', $code)->get();

        if (null === $views || 0 >= count($views)) {
            return null;
        }

        return $views;
    }

    public static function getViewAttribute($value)
    {
        return 'themes.default.' . $value;
    }    
}
