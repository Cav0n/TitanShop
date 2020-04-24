<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity')->default(1);
            $table->bigInteger('cart_id')->unsigned();
            $table->bigInteger('product_id')->unsigned();

            $table->foreign('cart_id')
                    ->references('id')->on('carts')
                    ->onDelete('cascade');

            $table->foreign('product_id')
                ->references('id')->on('product_bases')
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
        Schema::dropIfExists('cart_items');
    }
}
