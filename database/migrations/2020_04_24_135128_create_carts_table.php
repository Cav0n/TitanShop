<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->string('token');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->bigInteger('shipping_address_id')->unsigned()->nullable();
            $table->bigInteger('billing_address_id')->unsigned()->nullable();
            $table->bigInteger('user_id')->unsigned()->nullable();

            $table->foreign('shipping_address_id')
                    ->references('id')->on('addresses')
                    ->onDelete('cascade');

            $table->foreign('billing_address_id')
                    ->references('id')->on('addresses')
                    ->onDelete('cascade');

            $table->foreign('user_id')
                    ->references('id')->on('users')
                    ->onDelete('cascade');

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
        Schema::dropIfExists('carts');
    }
}
