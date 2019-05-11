<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id', true);
            $table->string('productName', 60);
            $table->string('aboutProduct', 60);
            $table->string('Status', 10);
            $table->double('Price')->unsigned();
            $table->integer('category_id')->unsigned();
            // $table->integer('company_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('category');
            // $table->foreign('company_id')->references('id')->on('company');
            $table->string('picture', 60);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');

    }






}

