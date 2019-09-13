<?php

use App\Grade;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class GradeTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    Grade::insert([
      ['grade' => 'SD'],
      ['grade' => 'SMP'],
      ['grade' => 'SMA']
    ]);
  }
}
