<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id', 11);
            $table->string('firstname', 150);
            $table->string('lastname', 150);
            $table->string('email', 150)->unique();
            $table->string('password', 255);
            $table->string('profilepicture', 255);
            $table->string('address', 150);
            $table->string('zipcode', 20);
            $table->string('location', 150);
            $table->string('province', 100);
            $table->string('country', 50);
            $table->string('telephone', 30);
            $table->string('mobile', 30);
            $table->text('biography', 1000);
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('role')->default(0);
            $table->rememberToken();
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
        Schema::drop('users');
    }
}
