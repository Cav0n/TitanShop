<?php

namespace Tests\Feature;

use App\CategoryBase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use \App\CategoryI18n;

class CategoryI18nTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic category creation test
     *
     * @return void
     */
    public function testCompleteCreation()
    {
        $category = CategoryTest::createCompleteCategory();

        $categoryI18n = self::createCompleteCategoryI18n($category);

        $this->assertNotNull($categoryI18n);
    }

    /**
     * Test if creation of categoryI18n fails if it has no category associated
     *
     * @return void
     */
    public function testCreationFailsWithoutCategory()
    {
        $categoryI18n = new CategoryI18n();
        $categoryI18n->lang = 'FR';
        $categoryI18n->title = 'Test de catégorie';
        $categoryI18n->description = 'Ceci est un test de catégorie';

        $this->expectException(\Illuminate\Database\QueryException::class);

        $categoryI18n->save();
    }

    /**
     * Create a complete category
     *
     * @return CategoryI18n
     */
    public function createCompleteCategoryI18n(CategoryBase $category, $lang = 'FR')
    {
        $categoryI18n = new CategoryI18n();
        $categoryI18n->category_base_id = $category->id;
        $categoryI18n->lang = $lang;
        $categoryI18n->title = "Un petit titre de catégorie";
        $categoryI18n->description = "Une petite description";
        $categoryI18n->save();

        return $categoryI18n;
    }
}
