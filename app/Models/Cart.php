<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }

    public function items()
    {
        return $this->hasMany('App\Models\CartItem');
    }
}
