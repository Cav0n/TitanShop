<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryI18n extends Model
{
    /**
     * Get base category of the translation
     */
    public function category()
    {
        return $this->belongsTo('App\CategoryBase');
    }
}
