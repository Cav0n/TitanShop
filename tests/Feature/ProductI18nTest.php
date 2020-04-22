<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use \App\ProductI18n;
use \App\ProductBase;

class ProductI18nTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic product i18n creation test
     *
     * @return void
     */
    public function testCompleteCreation()
    {
        $product = ProductTest::createCompleteProduct();

        $productI18n = self::createCompleteProductI18n($product);

        $this->assertNotNull($productI18n);
    }

    /**
     * Test if creation of productI18n fails if it has no product associated
     *
     * @return void
     */
    public function testCreationFailsWithoutProduct()
    {
        $productI18n = new ProductI18n();
        $productI18n->lang = 'FR';
        $productI18n->title = 'Test de produit';
        $productI18n->description = 'Ceci est un test de produit';

        $this->expectException(\Illuminate\Database\QueryException::class);

        $productI18n->save();
    }

    /**
     * Create a complete productI18n
     *
     * @param  mixed $product
     * @return void
     */
    public static function createCompleteProductI18n(ProductBase $product, $lang = 'FR')
    {
        $productI18n = new ProductI18n();
        $productI18n->lang = $lang;
        $productI18n->title = 'Test de produit';
        $productI18n->description = 'Ceci est un test de produit';
        $productI18n->product_base_id = $product->id;
        $product->save();

        return $product;
    }
}
