<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use \App\Image;

class ImageTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic image creation test
     *
     * @return void
     */
    public function testCompleteCreation()
    {
        $image = self::createCompleteImage();

        $this->assertNotNull($image);
    }

    /**
     * Test if size is well formatted
     *
     * @return void
     */
    public function testFormattedSize()
    {
        $image = self::createCompleteImage(0);
        $this->assertEquals('Taille de l\'image inconnue.', $image->sizeFormatted);

        $image = self::createCompleteImage(10);
        $this->assertEquals('10 o', $image->sizeFormatted);

        $image = self::createCompleteImage(15800);
        $this->assertEquals('15.80 Ko', $image->sizeFormatted);

        $image = self::createCompleteImage(124860000);
        $this->assertEquals('124.86 Mo', $image->sizeFormatted);

        $image = self::createCompleteImage(10000000000);
        $this->assertEquals('10.00 Go', $image->sizeFormatted);
    }

     /**
     * Create a complete image
     *
     * @return Image
     */
    public static function createCompleteImage($size = 16000)
    {
        $image = new Image();
        $image->path = "images/utils/question-mark.png";
        $image->alt = "question mark";
        $image->size = $size;
        $image->save();

        return $image;
    }
}
