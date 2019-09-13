<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
  protected $guarded = ['id'];

  public function profiles()
  {
    return $this->hasMany(Profile::class);
  }
}
