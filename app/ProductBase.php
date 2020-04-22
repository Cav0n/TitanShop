<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductBase extends Model
{
    /**
     * Get product translations
     */
    public function i18ns()
    {
        return $this->hasMany('App\ProductI18n');
    }

    /**
     * Set product price from double / float
     */
    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = $value * 100;
    }

    /**
     * Get product price from integer
     */
    public function getPriceAttribute($value)
    {
        return $value / 100;
    }


    /**
     * Get product formatted price
     */
    public function getPriceFormattedAttribute()
    {
        return \number_format($this->price, 2, ",", " ") . ' €';
    }

    /**
     * Set product promo price from double / float
     */
    public function setPromoPriceAttribute($value)
    {
        $this->attributes['promoPrice'] = $value * 100;
    }

    /**
     * Get product promo price from integer
     */
    public function getPromoPriceAttribute($value)
    {
        return $value / 100;
    }

    /**
     * Get product formatted promo price
     */
    public function getPromoPriceFormattedAttribute()
    {
        return \number_format($this->price, 2, ",", " ") . ' €';
    }
}
