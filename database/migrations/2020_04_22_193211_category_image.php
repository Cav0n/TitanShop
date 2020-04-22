<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CategoryImage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_base_image', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('rank')->unsigned()->default(0);
            $table->bigInteger('image_id')->unsigned();
            $table->bigInteger('category_base_id')->unsigned();

            $table->foreign('image_id')
                    ->references('id')->on('images')
                    ->onDelete('cascade');

            $table->foreign('category_base_id')
                    ->references('id')->on('category_bases')
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
