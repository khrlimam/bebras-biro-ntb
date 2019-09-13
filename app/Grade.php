<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
  protected $guarded = ['id'];

  public function modules()
  {
    return $this->hasMany(Module::class);
  }

  public function profiles()
  {
    return $this->hasMany(Profile::class);
  }

}
