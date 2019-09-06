<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('answers', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->bigInteger('attempt_id');
      $table->bigInteger('soal_id');
      $table->string('jawaban');
      $table->boolean('correct');
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
    Schema::dropIfExists('answers');
  }
}
