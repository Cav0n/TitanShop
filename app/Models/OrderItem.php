<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    public function __construct(CartItem $cartItem, Order $order)
    {
        parent::__construct();

        $this->order_id = $order->id;
        $this->product_id = $cartItem->product->id;
        $this->title = $cartItem->product->i18nValue('title');
        $this->price = $cartItem->product->price;
        $this->quantity = $cartItem->quantity;
    }

    public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }
}
