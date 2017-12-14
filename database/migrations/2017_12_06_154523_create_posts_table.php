<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
	    $table->engine = 'InnoDB';
            $table->increments('id');
  	    $table->integer('user_id')->index()->unsigned();
	    $table->integer('category_id')->index()->unsigned();
	    $table->integer('photo_id')->index()->unsigned();
	    $table->string('title');
	    $table->text('body');
            $table->timestamps();

	    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
	    $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('posts');
    }
}
