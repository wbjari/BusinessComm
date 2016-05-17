<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('companies', function (Blueprint $table) {
          $table->increments('id');
          $table->string('name');
          $table->string('slogan');
          $table->string('logo');
          $table->string('email');
          $table->integer('telephone');
          $table->string('biography');
          $table->string('address');
          $table->string('zipcode');
          $table->string('location');
          $table->string('province');
          $table->string('country');
          $table->integer('category_id');
          $table->integer('status');
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
        Schema::drop('companies');
    }
}
