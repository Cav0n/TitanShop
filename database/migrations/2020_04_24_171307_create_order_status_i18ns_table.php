<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderStatusI18nsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_status_i18ns', function (Blueprint $table) {
            $table->id();

            $table->string('lang')->default('FR');
            $table->string('title');
            $table->bigInteger('order_status_id')->unsigned();

            $table->foreign('order_status_id')
                    ->references('id')->on('order_statuses')
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
        Schema::dropIfExists('order_status_i18ns');
    }
}
