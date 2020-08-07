<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Customer extends Model
{
    public function __toString()
    {
        return $this->firstname . ' ' . $this->lastname;
    }

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

    public function addresses()
    {
        return $this->hasMany('App\Models\PostalAdress');
    }

    public static function check(\Illuminate\Http\Request $request): bool
    {
        if (! $request->session()->has('customer_id')) {
            return false;
        }

        if (! $request->session()->has('customer_hash')) {
            return false;
        }

        $id = $request->session()->get('customer_id');
        $hash = $request->session()->get('customer_hash');
        // $currentIpAddress = $request->ip(); // Maybe not a good idea

        if (null === $customer = Customer::where('id', $id)->first()) {
            return false;
        }

        if (! Hash::check($customer->email . $customer->password, $hash)) {
            return false;
        }

        return true;
    }
}
