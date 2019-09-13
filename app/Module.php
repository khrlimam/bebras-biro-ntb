<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
  protected $guarded = ['id'];

  public function soalCount()
  {
    return $this->soals()->count('id');
  }

  public function grade()
  {
    return $this->belongsTo(Grade::class, 'grade_id');
  }

  public function soals()
  {
    return $this->hasMany(Soal::class);
  }

  public function attempts()
  {
    return $this->hasMany(Attempt::class);
  }
}
