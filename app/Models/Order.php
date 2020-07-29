<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Order extends Model
{
    public function __construct(array $attributes = [], Cart $cart = null)
    {
        parent::__construct();

        if ($cart !== null) {
            $this->token = Str::random(8);
            $this->customer_id = $cart->customer_id;
            $this->email = $cart->email;
            $this->phone = $cart->phone;
            $this->shipping_address_id = $cart->shipping_address_id;
            $this->billing_address_id = $cart->billing_address_id;
            $this->paymentMethod = $cart->paymentMethod;
            $this->customerMessage = $cart->customerMessage;
        }
    }

    public function getCustomerIdentityAttribute()
    {
        if (null !== $customer = $this->customer) {
            return $customer;
        }

        return $this->shippingAddress->firstname . ' ' . $this->shippingAddress->lastname;
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

    public function getTotalQuantityAttribute()
    {
        $quantity = 0;

        foreach ($this->items as $item) {
            $quantity += $item->quantity;
        }

        return $quantity;
    }

    public function getItemsPriceAttribute()
    {
        $price = 0;

        foreach ($this->items as $item) {
            $price += $item->price;
        }

        return $price;
    }

    public function getItemsPriceFormattedAttribute()
    {
        return number_format($this->itemsPrice, 2, ',', ' ') . ' €';
    }

    public function getShippingPriceAttribute()
    {
        return Cart::SHIPPING_PRICE;
    }

    public function getShippingPriceFormattedAttribute()
    {
        return number_format($this->shippingPrice, 2, ',', ' ') . ' €';
    }

    public function getTotalPriceAttribute()
    {
        return $this->itemsPrice + $this->shippingPrice;
    }

    public function getTotalPriceFormattedAttribute()
    {
        return number_format($this->totalPrice, 2, ',', ' ') . ' €';
    }
}
