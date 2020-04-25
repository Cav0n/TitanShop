<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Address;

class AddressTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic address creation test
     *
     * @return void
     */
    public function testCompleteCreation()
    {
        $address = self::createCompleteAddress();

        $this->assertNotNull($address);
    }

    /**
     * Create a complete address
     *
     * @return Address
     */
    public static function createCompleteAddress()
    {
        $address = new Address();
        $address->firstname = "Florian";
        $address->lastname = "Bernard";
        $address->street = "1 rue des paquerettes";
        $address->zipCode = "63000";
        $address->city = "Clermont-Ferrand";
        $address->save();

        return $address;
    }
}
