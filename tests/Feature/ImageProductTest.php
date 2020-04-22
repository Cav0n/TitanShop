<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ImageProductTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test product creation link with one image
     *
     * @return void
     */
    public function testProductLinkWithOneImage()
    {
        $product = ProductTest::createCompleteProduct();
        $image = ImageTest::createCompleteImage();
        $image2 = ImageTest::createCompleteImage();

        $product->images()->attach($image->id, ['rank' => 1]);

        $this->assertEquals(1, count($product->images));

        $this->assertEquals(1, $product->images[0]->pivot->rank);
    }

    /**
     * Test product creation link with multiple images
     *
     * @return void
     */
    public function testProductLinkWithMultipleImages()
    {
        $product = ProductTest::createCompleteProduct();
        $image = ImageTest::createCompleteImage();
        $image2 = ImageTest::createCompleteImage();

        $product->images()->attach($image->id, ['rank' => 1]);
        $product->images()->attach($image2->id, ['rank' => 2]);

        $this->assertEquals(2, count($product->images));

        $this->assertEquals(1, $product->images[0]->pivot->rank);
        $this->assertEquals(2, $product->images[1]->pivot->rank);
    }
}
