<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryBasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_bases', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('parent_id')->unsigned()->nullable();
            $table->boolean('isVisible')->default(0);
            $table->boolean('isDeleted')->default(0);
            $table->timestamps();
        });

        Schema::table('category_bases', function (Blueprint $table) {
            $table->foreign('parent_id')
                    ->references('id')->on('category_bases')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_bases');
    }
}
