<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;

class CustomerTest extends TestCase
{
    use RefreshDatabase;

    public function testCompleteCreation()
    {
        $customer = self::create();

        $customer->save();

        $this->assertNotNull($customer);
    }

    public function testExistingEmailCreation()
    {
        $customer = self::create(
            null,
            null,
            "fbernard@test.fr"
        );

        $customer->save();

        $this->assertNotNull($customer);

        $customer2 = self::create(
            null,
            null,
            "fbernard@test.fr"
        );

        $this->expectException(\Illuminate\Database\QueryException::class);

        $customer2->save();
    }

    public function testCart()
    {
        $customer = self::create();
        $customer->save();

        $cart = CartTest::create($customer->id);
        $cart->save();

        $product = ProductTest::create();
        $product->save();

        $item = CartTest::createItem($cart->id, $product->id);
        $item->save();

        $this->assertNotNull($customer->carts);
        $this->assertNotNull($customer->activeCart());
        $this->assertEquals(1, count($customer->activeCart->items));
    }

    public static function create(
        $firstname = null,
        $lastname = null,
        $email = null,
        $phone = null,
        $password = null,
        $lang = null,
        $isActivated = null
    ) {
        $customer = new Customer();
        $customer->firstname = $firstname ?? "Florian";
        $customer->lastname = $lastname ?? "Bernard";
        $customer->email = $email ?? "fbernard@test.fr";
        $customer->phone = $phone ?? "0123456789";
        $customer->password = Hash::make($password ?? "Secret123!");
        $customer->lang = $lang ?? "fr";
        $customer->isActivated =$isActivated ?? true;

        return $customer;
    }
}
