<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use \App\ProductBase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic product creation test
     *
     * @return void
     */
    public function testCreation()
    {
        $product = new ProductBase();
        $product->price = 9.99;
        $product->stock = 100;
        $product->save();

        $this->assertNotNull($product);
    }
}
