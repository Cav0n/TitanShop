<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class ProductI18n extends Model
{
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    public static function validator(array $data)
    {
        return Validator::make($data, [
            'product_id' => ['nullable', 'exists:products,id'],
            'title' => ['required', 'string', 'min:2', 'max:255'],
            'description' => ['required', 'string'],
            'summary' => ['nullable', 'string', 'min:2', 'max:255'],
            'lang' => ['required']
        ]);
    }
}
