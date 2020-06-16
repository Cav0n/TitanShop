<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
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

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }
}
