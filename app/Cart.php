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
}
