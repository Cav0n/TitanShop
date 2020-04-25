<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Cart extends Model
{
    /**
     * Get cart items
     */
    public function items()
    {
        return $this->hasMany('App\CartItem');
    }

    /**
     * Get cart shipping address
     */
    public function shippingAddress()
    {
        return $this->belongsTo('App\Address', 'shipping_address_id');
    }

    /**
     * Get cart billing address
     */
    public function billingAddress()
    {
        return $this->belongsTo('App\Address', 'billing_address_id');
    }

    /**
     * Get cart user
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function getTotalQuantityAttribute()
    {
        $quantity = 0;

        foreach ($this->items as $item) {
            $quantity += $item->quantity;
        }

        return $quantity;
    }

    /**
     * Get cart total price
     *
     * @return void
     */
    public function getTotalPriceAttribute()
    {
        $price = 0;

        foreach ($this->items as $item) {
            $price += $item->price;
        }

        return $price;
    }

    /**
     * Get cart total price formatted
     *
     * @return void
     */
    public function getTotalPriceFormattedAttribute()
    {
        return \number_format($this->totalPrice, 2, ",", " ") . ' €';
    }

    public function generateToken()
    {
        $this->token = Str::random(15);
    }
}
