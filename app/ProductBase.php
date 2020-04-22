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
     * Get images of the product
     */
    public function images()
    {
        return $this->belongsToMany('App\Image')->withPivot(['rank']);
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
        return \number_format($this->promoPrice, 2, ",", " ") . ' €';
    }

    /**
     * Return true if product is in promo
     */
    public function getIsInPromoAttribute()
    {
        return (null !== $this->promoPrice) && (0 !== $this->promoPrice) && ($this->promoPrice < $this->price);
    }

    /**
     * Return product availability
     * True if stock > 0, isVisible = 1 and isDeleted = 0
     *
     * @return void
     */
    public function getIsAvailableAttribute()
    {
        return (0 < $this->stock) && ($this->isVisible) && (!$this->isDeleted);
    }

    /**
     * Return product title i18n
     */
    public function getTitleAttribute($lang = 'FR')
    {
        $lang = (isset($lang)) ? $lang : 'FR';

        return $this->i18ns->where('lang', $lang)->first()->title;
    }
}
