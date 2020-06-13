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
    }

    public static function create(
        $path = null
    )
    {
        $image = new Image();
        $image->path = $path ?? public_path('images/utils/question-mark.png');

        return $image;
    }
}
