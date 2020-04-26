<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SettingI18n extends Model
{
    /**
     * Get base setting model
     */
    public function setting()
    {
        return $this->belongsTo('App\Setting');
    }
}
