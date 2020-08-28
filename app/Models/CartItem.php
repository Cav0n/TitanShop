<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    public function cart()
    {
        return $this->belongsTo('App\Models\Cart');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    public function getPriceAttribute()
    {
        return $this->product->price * $this->quantity;
    }

    public function getPriceFormattedAttribute()
    {
        return number_format($this->product->price * $this->quantity, 2, ',', ' ') . ' €';
    }
}
