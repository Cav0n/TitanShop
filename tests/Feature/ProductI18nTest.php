<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use \App\ProductI18n;

class ProductI18nTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic product i18n creation test
     *
     * @return void
     */
    public function testCreation()
    {
        $product = ProductTest::createCompleteProduct();

        $productI18n = new ProductI18n();
        $productI18n->lang = 'FR';
        $productI18n->title = 'Test de produit';
        $productI18n->description = 'Ceci est un test de produit';
        $productI18n->product_id = $product->id;

        $productI18n->save();

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
}
