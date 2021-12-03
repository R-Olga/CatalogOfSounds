<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title', 50)->unique();

        });

        Schema::create('statuses', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title')->unique();
        });

        Schema::create('songs', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title', 255);
            $table->integer('category_id')->unsigned();
            $table->integer('status_id')->default(1)->unsigned();
            $table->string('songPath');
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('status_id')->references('id')->on('statuses');
        });

        Schema::create('complaints',function(Blueprint $table) {
            $table->increments('id');
            $table->integer('song_id')->unsigned();
            $table->text('description');
            $table->integer('status_id')->default(1)->unsigned();
            $table->timestamps();

            $table->foreign('song_id')->references('id')->on('songs')->onDelete('cascade');
            $table->foreign('status_id')->references('id')->on('statuses');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
        Schema::dropIfExists('statuses');
        Schema::dropIfExists('songs');
        Schema::dropIfExists('complaints');
    }
}
