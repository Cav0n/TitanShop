<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('token')->unique();
            $table->foreignId('customer_id')->nullable()->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('shipping_address_id');
            $table->unsignedBigInteger('billing_address_id');
            $table->string('email');
            $table->string('phone')->nullable();

            $table->foreign('shipping_address_id')->references('id')->on('addresses');
            $table->foreign('billing_address_id')->references('id')->on('addresses');

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
        Schema::dropIfExists('orders');
    }
}
