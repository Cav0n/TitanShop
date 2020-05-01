<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    /**
     * Get all orders with status
     */
    public function orders()
    {
        return $this->hasMany('App\Order');
    }
}
