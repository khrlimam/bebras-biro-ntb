<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pilihan extends Model
{
  protected $guarded = ['id'];

  public function soal()
  {
    return $this->belongsTo(Soal::class, 'soal_id');
  }

}
