<?php

namespace App;

use App\Util\Util;
use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{

  protected $guarded = ['id'];
  protected $hidden = ['jawaban'];

  public function modules()
  {
    return $this->belongsTo(Module::class, 'module_id');
  }

  public function pilihans()
  {
    return $this->hasMany(Pilihan::class);
  }

  public function answers()
  {
    return $this->hasMany(Answer::class);
  }

  public function normalizedMd5Answer()
  {
    return Util::normalizedMd5Answer($this->jawaban);
  }

}
