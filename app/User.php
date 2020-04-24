<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Hashing password before save.
     */
    public function setPasswordAttributes($value)
    {
        $this->attribute['password'] = Hash::make($value);
    }

    public function getEmailPrettyAttribute()
    {
        return strtolower($this->email);
    }

    public function getPhonePrettyAttribute()
    {
        return null !== $this->phone ? chunk_split($this->phone, 2, ' ') : 'Non défini';
    }
}
