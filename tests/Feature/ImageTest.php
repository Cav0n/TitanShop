<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Image;
use App\Models\ImageI18n;
use Illuminate\Http\Request;

class ImageTest extends TestCase
{
    use RefreshDatabase;

    public function testCompleteCreation()
    {
        $image = self::create();

        $image->save();

        $this->assertNotNull($image);

        $imageI18n = self::createI18n();

        $imageI18n->save();

        $this->assertNotNull($imageI18n);
    }

    public static function create(
        $path = null
    ) {
        $image = new Image();
        $image->path = $path ?? public_path('images/utils/question-mark.png');

        return $image;
    }

    public static function createI18n(
        $image_id = null,
        $lang = null,
        $alt = null,
        $title = null
    ) {
        $imageI18n = new ImageI18n();
        $imageI18n->image_id = $image_id;
        $imageI18n->lang = $lang;
        $imageI18n->alt = $alt;
        $imageI18n->title = $title;

        return $imageI18n;
    }  
}
