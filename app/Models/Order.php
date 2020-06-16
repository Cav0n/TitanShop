<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }

    public function shippingAddress()
    {
        return $this->belongsTo('App\Models\Address', 'shipping_address_id');
    }

    public function billingAddress()
    {
        return $this->belongsTo('App\Models\Address', 'billing_address_id');
    }

    public function items()
    {
        return $this->hasMany('App\Models\OrderItem');
    }
}
