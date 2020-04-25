<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\User;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic user creation test
     *
     * @return void
     */
    public function testCompleteCreation()
    {
        $user = self::createCompleteUser();

        $this->assertNotNull($user);
    }

    /**
     * A user creation without phone number test
     *
     * @return void
     */
    public function testCreationWithoutPhoneNumber()
    {
        $user = self::createUserWithoutPhoneNumber();

        $this->assertNotNull($user);
    }

    /**
     * Test if user creation without email fails
     *
     * @return void
     */
    public function testCreationWithoutEmailFails()
    {
        $user = new User();
        $user->firstname = 'Florian';
        $user->lastname = 'Bernard';
        $user->password = 'mySecretPassword';

        $this->expectException(\Illuminate\Database\QueryException::class);

        $user->save();
    }

    /**
     * Test if user creation without phone number fails
     *
     * @return void
     */
    public function testCreationWithoutPasswordFails()
    {
        $user = new User();
        $user->firstname = 'Florian';
        $user->lastname = 'Bernard';
        $user->email = 'example@email.fr';

        $this->expectException(\Illuminate\Database\QueryException::class);

        $user->save();
    }

    public function testCartAttach()
    {
        $user = self::createCompleteUser();
        $cart = CartTest::createSimpleCart();

        $cart->user_id = $user->id;
        $cart->save();

        $this->assertNotNull($user);
        $this->assertNotNull($cart);
        $this->assertNotNull($user->carts);
        $this->assertEquals(1, count($user->carts));
    }

    /**
     * Create a complete user
     *
     * @return User
     */
    public static function createCompleteUser()
    {
        $user = new User();
        $user->firstname = 'Florian';
        $user->lastname = 'Bernard';
        $user->phone = '0123456789';
        $user->email = 'example@email.fr';
        $user->password = 'mySecretPassword';
        $user->save();

        return $user;
    }

    /**
     * Create a user without phone number
     *
     * @return User
     */
    public static function createUserWithoutPhoneNumber()
    {
        $user = new User();
        $user->firstname = 'Florian';
        $user->lastname = 'Bernard';
        $user->email = 'example@email.fr';
        $user->password = 'mySecretPassword';
        $user->save();

        return $user;
    }
}
