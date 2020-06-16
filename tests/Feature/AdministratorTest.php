<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Administrator;
use Illuminate\Support\Facades\Hash;

class AdministratorTest extends TestCase
{
    use RefreshDatabase;

    public function testCompleteCreation()
    {
        $administrator = self::create();

        $administrator->save();

        $this->assertNotNull($administrator);
    }

    public function testExistingNicknameCreation()
    {
        $administrator1 = self::create(
            null,
            null,
            "fbernard",
            "fbernard@test.fr"
        );

        $administrator1->save();

        $this->assertNotNull($administrator1);

        $administrator2 = self::create(
            null,
            null,
            "fbernard",
            "fbernard@test2.fr"
        );

        $this->expectException(\Illuminate\Database\QueryException::class);

        $administrator2->save();
    }

    public function testExistingEmailCreation()
    {
        $administrator1 = self::create(
            null,
            null,
            "fbernard",
            "fbernard@test.fr"
        );

        $administrator1->save();

        $this->assertNotNull($administrator1);

        $administrator2 = self::create(
            null,
            null,
            "lecoinks",
            "fbernard@test.fr"
        );

        $this->expectException(\Illuminate\Database\QueryException::class);

        $administrator2->save();
    }

    public static function create(
        $firstname = null,
        $lastname = null,
        $nickname = null,
        $email = null,
        $password = null,
        $lang = null,
        $isActivated = null
    ) {
        $administrator = new Administrator();
        $administrator->firstname = $firstname ?? "Florian";
        $administrator->lastname = $lastname ?? "Bernard";
        $administrator->nickname = $nickname ?? "fbernard";
        $administrator->email = $email ?? "fbernard@test.fr";
        $administrator->password = Hash::make($password ?? "Secret123!");
        $administrator->lang = $lang ?? "fr";
        $administrator->isActivated =$isActivated ?? true;

        return $administrator;
    }
}
