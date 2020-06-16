<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public function getFirstnameAttribute($value) {
        return ucfirst($value);
    }

    public function setFirstnameAttribute($value) {
        $this->attributes['firstname'] = ucfirst($value);
    }

    public function getLastnameAttribute($value) {
        return ucfirst($value);
    }

    public function setLastnameAttribute($value) {
        $this->attributes['lastname'] = ucfirst($value);
    }

    public function carts()
    {
        return $this->hasMany('App\Models\Cart');
    }

    public function activeCart()
    {
        return $this->hasOne('App\Models\Cart')->where('isActive', 1);
    }
}
