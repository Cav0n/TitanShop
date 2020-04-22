<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use \App\CategoryBase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic category creation test
     *
     * @return void
     */
    public function testCompleteCreation()
    {
        $category = self::createCompleteCategory();

        $this->assertNotNull($category);
    }

    /**
     * Create a category and adding a parent category to it
     */
    public function testAddParentToCategory()
    {
        $category = self::createCompleteCategory();
        $child = self::createCompleteCategory();

        $child->parent_id = $category->id;
        $child->save();

        $this->assertNotNull($child->parent);
        $this->assertNotNull($category->childs);
        $this->assertEquals(1, count($category->childs));
    }

    /**
     * Create a complete category
     *
     * @return CategoryBase
     */
    public static function createCompleteCategory()
    {
        $category = new CategoryBase();
        $category->save();

        return $category;
    }
}
