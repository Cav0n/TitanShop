<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    /**
     * Get cart of the item
     */
    public function cart()
    {
        return $this->belongsTo('App\Cart');
    }

    /**
     * Get product of the item
     */
    public function product()
    {
        return $this->belongsTo('App\ProductBase', 'product_id');
    }

    /**
     * Get total price of the item not formatted
     *
     * @return void
     */
    public function getPriceAttribute()
    {
        return $this->product->price * $this->quantity;
    }

    /**
     * Get total price of the item formatted
     *
     * @return void
     */
    public function getPriceFormattedAttribute()
    {
        return \number_format($this->product->price * $this->quantity, 2, ",", " ") . ' €';
    }
}
