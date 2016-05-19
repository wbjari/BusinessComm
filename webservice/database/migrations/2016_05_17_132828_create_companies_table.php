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
          $table->increments('id', 11);
          $table->string('name', 150);
          $table->string('slogan', 200);
          $table->string('logo', 255);
          $table->string('email', 150);
          $table->string('telephone', 30);
          $table->text('biography', 1000);
          $table->string('address', 150);
          $table->string('zipcode', 20);
          $table->string('location', 150);
          $table->string('province', 150);
          $table->string('country', 150);
          $table->tinyInteger('category_id');
          $table->tinyInteger('status')->default(1);
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
