<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModulesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('modules', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->string('title', 255);
      $table->text('description');
      $table->enum('jenis', ['latihan', 'ujian']);
      $table->bigInteger('grade_id');
      $table->integer('waktu');
      $table->string('media_path')->nullable();
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
    Schema::dropIfExists('modules');
  }
}
