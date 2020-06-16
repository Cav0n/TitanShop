<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public function customer()
    {
        return $this->belongsTo('App\Models\CartItem');
    }

    public function items()
    {
        return $this->hasMany('App\Models\CartItem');
    }
}
