<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
  protected $guarded = [];

  public function user()
  {
    return $this->belongsTo(User::class, 'username');
  }

  public function grade()
  {
    return $this->belongsTo(Grade::class, 'grade_id');
  }

  public function school() {
    return $this->belongsTo(School::class, 'school_id');
  }

}
