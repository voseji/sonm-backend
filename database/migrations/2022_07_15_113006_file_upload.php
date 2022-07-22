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
      Schema::create('files', function (Blueprint $table) {
        $table->engine = 'InnoDB';
      $table->increments('id');
      // $table->string('special');
      $table->string('path');
      $table->timestamps();

      $table->string('special');
      $table->foreign('special')->references('special')->on('students');
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
        Schema::dropIfExists('files');
    }
};
