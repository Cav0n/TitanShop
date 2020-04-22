<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ImageCategoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test product creation link with one image
     *
     * @return void
     */
    public function testCategoryLinkWithOneImage()
    {
        $category = CategoryTest::createCompleteCategory();
        $image = ImageTest::createCompleteImage();
        $image2 = ImageTest::createCompleteImage();

        $category->images()->attach($image->id, ['rank' => 1]);

        $this->assertEquals(1, count($category->images));

        $this->assertEquals(1, $category->images[0]->pivot->rank);
    }

    /**
     * Test product creation link with multiple images
     *
     * @return void
     */
    public function testCategoryLinkWithMultipleImages()
    {
        $category = CategoryTest::createCompleteCategory();
        $image = ImageTest::createCompleteImage();
        $image2 = ImageTest::createCompleteImage();

        $category->images()->attach($image->id, ['rank' => 1]);
        $category->images()->attach($image2->id, ['rank' => 2]);

        $this->assertEquals(2, count($category->images));

        $this->assertEquals(1, $category->images[0]->pivot->rank);
        $this->assertEquals(2, $category->images[1]->pivot->rank);
    }
}
