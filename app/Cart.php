<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    /**
     * Get cart items
     */
    public function items()
    {
        return $this->hasMany('App\CartItem');
    }
}
