<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ImageProductBase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image_product_base', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('rank')->unsigned()->default(0);
            $table->bigInteger('image_id')->unsigned();
            $table->bigInteger('product_base_id')->unsigned();

            $table->foreign('image_id')
                    ->references('id')->on('images')
                    ->onDelete('cascade');

            $table->foreign('product_base_id')
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
        //
    }
}
