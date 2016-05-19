<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
       Schema::create('company_users', function (Blueprint $table) {
           $table->increments('id', 11);
           $table->integer('user_id')->unsigned();
           $table->integer('company_id')->unsigned();
           $table->tinyInteger('role')->default(0);
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
         Schema::drop('company_users');
     }
}
