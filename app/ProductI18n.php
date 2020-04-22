<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductI18n extends Model
{
    /**
     * Get base product of the translation
     */
    public function product()
    {
        return $this->belongsTo('App\ProductBase');
    }
}
