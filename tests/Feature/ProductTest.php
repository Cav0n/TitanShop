<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\ProductI18n;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    const DEFAULT_TITLE = "Un produit de test";
    const DEFAULT_DESCRIPTION = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam ac nisl sapien. Integer maximus diam mauris, nec gravida sem pellentesque ut. Suspendisse orci erat, tincidunt eget aliquam nec, elementum eu ligula.";
    const DEFAULT_SUMMARY = "Lorem ipsum dolor sit amet, consectetur adipiscing elit.";

    public function testCompleteCreation()
    {
        // Test simple product creation
        $product = self::create();
        $product->save();
        $this->assertNotNull($product);

        // Test i18n creation
        $productI18n = self::createI18n($product->id);
        $productI18n->save();
        $this->assertNotNull($productI18n);

        // Test relation between i18n and product
        $this->assertEquals(self::DEFAULT_TITLE, $product->i18nValue('title'));
        $this->assertEquals(self::DEFAULT_DESCRIPTION, $product->i18nValue('description'));
        $this->assertEquals(self::DEFAULT_SUMMARY, $product->i18nValue('summary'));

        // Test image product
        $image = ImageTest::create();
        $image->save();
        $product->images()->attach($image);
        $this->assertEquals(1, count($product->images));
    }

    public function testImagesPosition()
    {
        $product = self::create();
        $product->save();

        $image = ImageTest::create();
        $image->save();
        $product->images()->attach($image, ['position' => 1]);

        $image2 = ImageTest::create(public_path('images/utils/question-mark2.png'));
        $image2->save();
        $product->images()->attach($image2, ['position' => 3]);

        // Test product images position
        $this->assertEquals(1, $product->images[0]->pivot->position);
        $this->assertEquals(3, $product->images[1]->pivot->position);
    }

    public static function create(
        $code = null,
        $stock = null,
        $price = null,
        $isVisible = null,
        $isDeleted = null
    ) {
        $product = new Product();
        $product->code = $code ?? self::DEFAULT_TITLE;
        $product->stock = $stock ?? 10;
        $product->price = $price ?? 19.99;
        $product->isVisible = $isVisible ?? true;
        $product->isDeleted = $isDeleted ?? false;

        return $product;
    }

    public static function createI18n(
        $product_id,
        $title = null,
        $description = null,
        $summary = null
    ) {
        $productI18n = new ProductI18n();
        $productI18n->product_id = $product_id;
        $productI18n->title = $title ?? self::DEFAULT_TITLE;
        $productI18n->description = $description ?? self::DEFAULT_DESCRIPTION;
        $productI18n->summary = $summary ?? self::DEFAULT_SUMMARY;

        return $productI18n;
    }
}