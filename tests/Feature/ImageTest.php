<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Image;
use App\Models\ImageI18n;

class ImageTest extends TestCase
{
    use RefreshDatabase;

    public function testCompleteCreation()
    {
        // Test simple image creation
        $image = self::create();
        $image->save();
        $this->assertNotNull($image);

        // Test i18n creation
        $imageI18n = self::createI18n($image->id);
        $imageI18n->save();
        $this->assertNotNull($imageI18n);

        // Test relation between i18n and image
        $this->assertEquals('image de test', $image->i18nValue('title'));
        $this->assertEquals('image de test', $image->i18nValue('alt'));
    }

    public static function create(
        $path = null,
        $url = null,
        $size = null
    ) {
        $image = new Image();
        $image->path = $path ?? public_path('images/utils/question-mark.png');
        $image->url = $url ?? asset('images/utils/question-mark.png') . '?randomize=' . rand(0,5000);
        $image->size = $size ?? rand(100000, 5000000);

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
        $imageI18n->lang = $lang ?? 'fr';
        $imageI18n->alt = $alt ?? 'image de test';
        $imageI18n->title = $title ?? 'image de test';

        return $imageI18n;
    }
}
