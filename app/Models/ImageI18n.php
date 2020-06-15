<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class ImageI18n extends Model
{
    public function image()
    {
        return $this->belongsTo('App\Models\Image');
    }

    public static function validator(array $data)
    {
        return Validator::make($data, [
            'image_id' => 'required|exists:images,id',
            'lang' => 'nullable',
            'alt' => 'nullable|min:2',
            'title' => 'nullable|min:2',
        ]);
    }

    public function storeValues(array $values)
    {
        $this->image_id = $values['image_id'];
        $this->lang = $values['lang'];
        $this->alt = $values['alt'];
        $this->title = $values['title'];

        $this->save();
    }
}
