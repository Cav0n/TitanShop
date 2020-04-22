<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryI18nsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_i18ns', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('category_base_id')->unsigned();
            $table->string('lang')->default('FR');
            $table->string('title');
            $table->text('description');

            $table->timestamps();
        });

        Schema::table('category_i18ns', function (Blueprint $table) {
            $table->foreign('category_base_id')
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
        Schema::dropIfExists('category_i18ns');
    }
}
