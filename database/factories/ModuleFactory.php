<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Module;
use Faker\Generator as Faker;

$factory->define(Module::class, function (Faker $faker) {
  return [
    'title' => $faker->text(10),
    'description' => $faker->realText(),
    'jenis' => ['latihan', 'ujian'][random_int(0, 1)],
    'grade_id' => random_int(1, 3),
    'media_path' => json_decode(file_get_contents('https://loremflickr.com/json/200/200/animal'))->file,
    'waktu' => random_int(50, 60)
  ];
});
