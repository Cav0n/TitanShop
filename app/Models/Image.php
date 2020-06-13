<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Image extends Model
{
    public static function validator(array $data)
    {
        return Validator::make($data, [
            'path' => 'required|min:2|max:255',
        ]);
    }

    public function i18ns()
    {
        return $this->hasMany('App\ImageI18n');
    }

    public function storeValues(array $values)
    {
        $this->path = $values['path'];

        $this->save();
    }
}
