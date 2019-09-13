<?php

use App\Module;
use App\Soal;
use Illuminate\Database\Seeder;

class ModuleTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    factory(Module::class, 30)->create()->each(function ($module) {
      factory(Soal::class, 2)->create([
        'module_id' => $module->id
      ]);
    });
  }
}
