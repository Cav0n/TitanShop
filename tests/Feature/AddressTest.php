<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Address;
use Illuminate\Support\Facades\Hash;

class AddressTest extends TestCase
{
    use RefreshDatabase;

    public function testCompleteCreation()
    {
        $address = self::create();
        $address->save();

        $this->assertNotNull($address);
    }

    public function testCreationWithCustomerId()
    {
        $address = self::create();
        $address->save();

        $customer = CustomerTest::create();
        $customer->save();

        $address->customer_id = $customer->id;
        $address->save();

        $this->assertNotNull($address->customer);
        $this->assertNotNull($address->customer->id);
    }

    public static function create(
        $firstname = null,
        $lastname = null,
        $company = null,
        $street = null,
        $additional = null,
        $zipCode = null,
        $city = null,
        $country = null,
        $customer_id = null
    ) {
        $address = new Address();
        $address->firstname = $firstname ?? "Florian";
        $address->lastname = $lastname ?? "Bernard";
        $address->company = $company;
        $address->street = $street ?? "13 Main St";
        $address->additional = $additional;
        $address->zipCode = $zipCode ?? "63000";
        $address->city = $city ?? "Los Angeles";
        $address->country = $country ?? "USA";
        $address->customer_id = $customer_id;

        return $address;
    }
}
