<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\CategoryI18n;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    const DEFAULT_TITLE = "Une catégorie de test";
    const DEFAULT_DESCRIPTION = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam ac nisl sapien. Integer maximus diam mauris, nec gravida sem pellentesque ut. Suspendisse orci erat, tincidunt eget aliquam nec, elementum eu ligula.";
    const DEFAULT_SUMMARY = "Lorem ipsum dolor sit amet, consectetur adipiscing elit.";

    public function testCompleteCreation()
    {
        // Test simple category creation
        $category = self::create();
        $category->save();
        $this->assertNotNull($category);

        // Test i18n creation
        $categoryI18n = self::createI18n($category->id);
        $categoryI18n->save();
        $this->assertNotNull($categoryI18n);

        // Test relation between i18n and category
        $this->assertEquals(self::DEFAULT_TITLE, $category->i18nValue('title'));
        $this->assertEquals(self::DEFAULT_DESCRIPTION, $category->i18nValue('description'));
        $this->assertEquals(self::DEFAULT_SUMMARY, $category->i18nValue('summary'));

        // Test image category
        $image = ImageTest::create();
        $image->save();
        $category->images()->attach($image);
        $this->assertEquals(1, count($category->images));

        $categoryI18n->title = 'test oui !';
        $categoryI18n->save();
    }

    public function testImagesPosition()
    {
        $category = self::create();
        $category->save();

        $image = ImageTest::create();
        $image->save();
        $category->images()->attach($image, ['position' => 1]);

        $image2 = ImageTest::create(public_path('images/utils/question-mark2.png'));
        $image2->save();
        $category->images()->attach($image2, ['position' => 3]);

        // Test product images position
        $this->assertEquals(1, $category->images[0]->pivot->position);
        $this->assertEquals(3, $category->images[1]->pivot->position);
    }

    public static function create(
        $code = null,
        $isVisible = null,
        $isDeleted = null
    ) {
        $category = new Category();
        $category->code = $code ?? null;
        $category->isVisible = $isVisible ?? true;
        $category->isDeleted = $isDeleted ?? false;

        return $category;
    }

    public static function createI18n(
        $category_id,
        $title = null,
        $description = null,
        $summary = null
    ) {
        $productI18n = new CategoryI18n();
        $productI18n->category_id = $category_id;
        $productI18n->title = $title ?? self::DEFAULT_TITLE;
        $productI18n->description = $description ?? self::DEFAULT_DESCRIPTION;
        $productI18n->summary = $summary ?? self::DEFAULT_SUMMARY;

        return $productI18n;
    }
}
