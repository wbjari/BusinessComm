<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
       Schema::create('reports', function (Blueprint $table) {
           $table->increments('id', 11);
           $table->integer('user_id')->unsigned();
           $table->string('reason', 255);
           $table->integer('reported_by')->unsigned();
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
         Schema::drop('reports');
     }
}
