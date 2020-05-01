<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    /**
     * Get order of the item
     */
    public function order()
    {
        return $this->belongsTo('App\Order');
    }

    /**
     * Get product of the item
     */
    public function product()
    {
        return $this->belongsTo('App\ProductBase', 'product_id');
    }

    /**
     * Set product price from double / float
     */
    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = $value * 100;
    }

    /**
     * Get product price from integer
     */
    public function getPriceAttribute($value)
    {
        return $value / 100;
    }

    /**
     * Get product formatted price
     */
    public function getPriceFormattedAttribute()
    {
        return \number_format($this->price, 2, ",", " ") . ' €';
    }

    /**
     * Get total product price from integer
     */
    public function getTotalPriceAttribute()
    {
        return $this->price * $this->quantity;
    }

    /**
     * Get total product formatted price
     */
    public function getTotalPriceFormattedAttribute()
    {
        return \number_format($this->totalPrice, 2, ",", " ") . ' €';
    }
}
