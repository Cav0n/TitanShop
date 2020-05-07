<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Admin extends Model
{
    const ROLES = [
        'SUPER_ADMIN',
        'ADMIN',
        'PRODUCT_CREATOR',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    public static function check()
    {
        if (session('admin')) {
            $admin = session('admin');
            if (self::where('email', $admin->email)->exists()) {
                return ( Hash::check($admin->token, self::where('email', $admin->email)->first()->token) );
            }

            session()->forget('admin');
        }

        return false;
    }

    public function getIdentityAttribute()
    {
        return $this->firstname . ' ' . $this->lastname;
    }
}
