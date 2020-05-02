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

    public function i18ns()
    {
        return $this->hasMany('App\OrderStatusI18n');
    }

    /**
     * Get status title
     */
    public function getTitleAttribute($lang = 'FR')
    {
        $lang = (isset($lang)) ? $lang : 'FR';

        return $this->i18ns->where('lang', $lang)->first()
                ? $this->i18ns->where('lang', $lang)->first()->title
                : $this->code;
    }

    /**
     * Get status badge
     */
    public function getBadgeAttribute()
    {
        $color = $this->color;
        $text = $this->title;

        return "<span class=\"badge\" style=\"background-color: $color\"><p>$text</p></span>";
    }
}
