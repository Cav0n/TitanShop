<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code', 'value', 'password',
    ];

    public static function valueOrNull(string $code)
    {
        return (Setting::where('code', $code)->exists() ? \App\Setting::where('code', $code)->first()->value : null);
    }
}
