<?php

namespace App\Models;

use App\Models\Utils\CustomString;
use Illuminate\Database\Eloquent\Model;

class CategoryI18n extends Model
{
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function setTitleAttribute($value)
    {
        if (null != $this->category) {
            $this->category->code = CustomString::prepareStringForURL($value);
            $this->category->save();
        }

        $this->attributes['title'] = $value;
    }
}
