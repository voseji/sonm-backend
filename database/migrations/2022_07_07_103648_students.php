<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('formNumber')->nullable();
            $table->string('firstName')->nullable();
            $table->string('lastName')->nullable();
            $table->string('otherNames')->nullable();
            $table->string('email')->nullable();
            $table->string('gender')->nullable();
            $table->string('maritalStatus')->nullable();
            $table->string('dateOfBirth')->nullable();
            $table->string('phoneNumber1')->nullable();
            $table->string('phoneNumber2')->nullable();
            $table->string('stateOfOrigin')->nullable();
            $table->string('lga')->nullable();
            $table->string('nationality')->nullable();
            $table->string('batch')->nullable();
            $table->string('registrationNumber')->nullable();
            
            $table->string('special')->unique();
            // $table->foreign('special')->references('special')->on('students');

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
        //
    }
};
