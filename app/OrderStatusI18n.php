<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderStatusI18n extends Model
{
    public function status()
    {
        return $this->belongsTo('App\OrderStatus');
    }
}
