<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserSkillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
       Schema::create('user_skills', function (Blueprint $table) {
           $table->increments('id', 11);
           $table->integer('user_id')->unsigned();
           $table->integer('skills_id')->unsigned();
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
         Schema::drop('user_skills');
     }
}
