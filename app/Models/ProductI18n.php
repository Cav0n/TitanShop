<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductI18n extends Model
{
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
}
