<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('company_reports', function (Blueprint $table) {
           $table->increments('id', 11);
           $table->integer('company_id')->unsigned();

           $table->string('reason', 255);

           $table->integer('reported_by')->unsigned();
           $table->foreign('reported_by')->references('id')->on('users');
           
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
        Schema::drop('company_reports');
    }
}
