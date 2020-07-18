<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Address extends Model
{
    protected $fillable = [
        'lastname',
        'firstname',
        'company',
        'street',
        'additional',
        'zipCode',
        'city',
        'country'
    ];

    public static function validator(array $data)
    {
        $rules = [
            'lastname' => ['required', 'string', 'min:2', 'max:255'],
            'firstname' => ['required', 'string', 'min:2', 'max:255'],
            'street' => ['required', 'string', 'min:2', 'max:255'],
            'zipCode' => ['required', 'string', 'min:5', 'max:5'],
            'city' => ['required', 'string', 'min:2', 'max:255'],
            'country' => ['required', 'string', 'min:2', 'max:255']
        ];

        return Validator::make($data, $rules);
    }

    public function getFirstnameAttribute($value)
    {
        return ucfirst($value);
    }

    public function setFirstnameAttribute($value)
    {
        $this->attributes['firstname'] = ucfirst($value);
    }

    public function getLastnameAttribute($value)
    {
        return ucfirst($value);
    }

    public function setLastnameAttribute($value)
    {
        $this->attributes['lastname'] = ucfirst($value);
    }

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }
}
