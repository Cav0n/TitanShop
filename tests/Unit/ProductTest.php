<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use \App\ProductBase;

class ProductTest extends TestCase
{
    /**
     * A basic product creation test
     *
     * @return void
     */
    public function creationTest()
    {
        $product = new ProductBase();
        $product->price = 9.99;
        $product->stock = 100;
        $product->save();

        $this->assertNotNull($product);
    }
}
