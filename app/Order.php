<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Order extends Model
{
    /**
     * Get order items
     */
    public function items()
    {
        return $this->hasMany('App\OrderItem');
    }

    /**
     * Get order shipping address
     */
    public function shippingAddress()
    {
        return $this->belongsTo('App\Address', 'shipping_address_id');
    }

    /**
     * Get order billing address
     */
    public function billingAddress()
    {
        return $this->belongsTo('App\Address', 'billing_address_id');
    }

    /**
     * Get order user
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get order total price
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
     * Get order total price formatted
     *
     * @return void
     */
    public function getTotalPriceFormattedAttribute()
    {
        return \number_format($this->totalPrice, 2, ",", " ") . ' €';
    }

    /**
     * Get order's shipping costs
     *
     * @return void
     */
    public function getShippingCostsAttribute($value)
    {
        return isset($value) ? $value / 100 : 0;
    }

    /**
     * Set order's shipping costs
     *
     * @return void
     */
    public function setShippingCostsAttribute($value)
    {
        $this->attributes['shippingCosts'] = $value * 100;
    }

    /**
     * Get order's shipping costs formatted
     *
     * @return void
     */
    public function getShippingCostsFormattedAttribute()
    {
        return \number_format($this->shippingCosts, 2, ",", " ") . ' €';
    }

    /**
     * Get order total price with shipping costs
     *
     * @return void
     */
    public function getTotalPriceWithShippingCostsAttribute()
    {
        $price = $this->totalPrice;
        $shippingCosts = $this->shippingCosts ?? 0;

        return $price + $shippingCosts;
    }

    /**
     * Get order total price formatted with shipping costs
     *
     * @return void
     */
    public function getTotalPriceWithShippingCostsFormattedAttribute()
    {
        return \number_format($this->totalPriceWithShippingCosts, 2, ",", " ") . ' €';
    }

    /**
     * Get customer firstname and lastname.
     * If customer was a connected user then it's the user firstname & lastname.
     * Else it's the shipping address firstname & lastname.
     *
     * @return void
     */
    public function getCustomerIdentityAttribute()
    {
        if (null !== $this->user) {
            return $this->user->identity;
        }

        return $this->shippingAddress->identity;
    }

    /**
     * Generate order's tracking number
     */
    public function generateTrackingNumber()
    {
        $this->trackingNumber = Str::random(12);
    }
}
