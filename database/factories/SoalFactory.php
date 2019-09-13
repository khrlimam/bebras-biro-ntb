<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Soal;
use Faker\Generator as Faker;

$factory->define(Soal::class, function (Faker $faker) {
  return [
    'soal' => $faker->randomHtml(),
    'jenis_jawaban' => 'isian',
    'jawaban' => $faker->text(5)
  ];
});
