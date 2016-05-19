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
           $table->increments('id', 11);
           $table->string('title', 150);
           $table->text('content', 10000);
           $table->integer('user_id')->unsigned();
           $table->integer('company_id')->unsigned();
           $table->string('image', 255);
           $table->integer('edited_by')->unsigned();
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
         Schema::drop('posts');
     }
}
