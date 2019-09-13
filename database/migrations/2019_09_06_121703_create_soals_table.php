<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoalsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('soals', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->bigInteger('module_id');
      $table->text('soal');
      $table->enum('jenis_jawaban', ['isian', 'pilihan']);
      $table->string('jawaban');
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
    Schema::dropIfExists('soals');
  }
}
