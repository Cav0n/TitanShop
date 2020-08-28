<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdministratorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('administrators', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('nickname')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('lang')->default('fr');
            $table->string('lastIpAddress')->nullable();
            $table->string('sessionToken')->nullable();
            $table->boolean('isActivated')->default(0);
            $table->boolean('isDeleted')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('administrators');
    }
}
