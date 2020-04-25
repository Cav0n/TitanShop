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
     * Generate order's tracking number
     */
    public function generateTrackingNumber()
    {
        $this->trackingNumber = Str::random(12);
    }
}
