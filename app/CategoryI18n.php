<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class CategoryI18n extends Model
{
    /**
     * CategoryI18n validator
     *
     * @param array $data
     * @return Validator
     */
    public static function validator(array $data)
    {
        $rules = [
            'title' => ['required', 'string', 'min:2', 'max:255'],
            'description' => ['required', 'string'],
            'lang' => ['nullable', 'string']
        ];

        return Validator::make($data, $rules);
    }

    /**
     * Get base category of the translation
     */
    public function category()
    {
        return $this->belongsTo('App\CategoryBase');
    }
}
