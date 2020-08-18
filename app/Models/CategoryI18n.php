<?php

namespace App\Models;

use App\Models\Utils\CustomString;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

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

    public static function validator(array $data)
    {
        return Validator::make($data, [
            'category_id' => ['nullable', 'exists:categories,id'],
            'title' => ['required', 'string', 'min:2', 'max:255'],
            'description' => ['required', 'string'],
            'summary' => ['nullable', 'string', 'min:2', 'max:255'],
            'lang' => ['required'],
        ]);
    }
}
