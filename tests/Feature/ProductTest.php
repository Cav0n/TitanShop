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
    public function testCompleteCreation()
    {
        $product = self::createCompleteProduct();

        $this->assertNotNull($product);
    }

    /**
     * A basic product without promo price creation test
     *
     * @return void
     */
    public function testCreationWithoutPromoPrice()
    {
        $product = self::createProductWithoutPromoPrice();

        $this->assertNotNull($product);
    }

    /**
     * A basic product without stock test
     *
     * @return void
     */
    public function testCreationWithoutStock()
    {
        $product = self::createProductWithoutStock();

        $this->assertNotNull($product);
    }

    /**
     * Test if product price is a double
     *
     * @return void
     */
    public function testPrice()
    {
        $product = self::createCompleteProduct();

        $this->assertTrue(\is_double($product->price));
    }

    /**
     * Test if product promo price is a double
     *
     * @return void
     */
    public function testPromoPrice()
    {
        $product = self::createCompleteProduct();

        $this->assertTrue(\is_double($product->promoPrice));
    }

    /**
     * Test if product is in promo
     *
     * @return void
     */
    public function testIsInPromo()
    {
        $product = self::createCompleteProduct();
        $this->assertTrue($product->isInPromo);
    }

    /**
     * Test if product is not in promo
     *
     * @return void
     */
    public function testIsNotInPromo()
    {
        $product = self::createProductWithoutPromoPrice();
        $this->assertFalse($product->isInPromo);
    }

    /**
     * Create a product
     *
     * @return ProductBase
     */
    public static function createCompleteProduct()
    {
        $product = new ProductBase();
        $product->price = 9.99;
        $product->promoPrice = 5.90;
        $product->stock = 100;
        $product->save();

        return $product;
    }

    /**
     * Create a product without promo price
     *
     * @return ProductBase
     */
    public static function createProductWithoutPromoPrice()
    {
        $product = new ProductBase();
        $product->price = 9.99;
        $product->stock = 100;
        $product->save();

        return $product;
    }

     /**
     * Create a product without stock
     *
     * @return ProductBase
     */
    public static function createProductWithoutStock()
    {
        $product = new ProductBase();
        $product->price = 9.99;
        $product->promoPrice = 5.90;
        $product->save();

        return $product;
    }
}
