<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Order extends Model
{
    public function __construct(Cart $cart)
    {
        parent::__construct();

        $this->token = Str::random(8);
        $this->customer_id = $cart->customer_id;
        $this->email = $cart->email;
        $this->phone = $cart->phone;
        $this->shipping_address_id = $cart->shipping_address_id;
        $this->billing_address_id = $cart->billing_address_id;
        $this->paymentMethod = $cart->paymentMethod;
    }

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
