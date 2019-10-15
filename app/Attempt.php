<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attempt extends Model
{

  protected $guarded = ['id'];
  protected $appends = ['done_time'];

  protected $casts = [
    'done' => 'boolean'
  ];

  protected $dates = ['created_at', 'updated_at'];

  public function module()
  {
    return $this->belongsTo(Module::class, 'module_id');
  }

  public function answers()
  {
    return $this->hasMany(Answer::class);
  }

  public function getDoneTimeAttribute()
  {
    return $this->updated_at->diffInSeconds($this->created_at);
  }

  public function doneTimeHumanDescription()
  {
    if ($this->done_time / 60 > 1) {
      $menit = round($this->done_time / 60);
      $detik = $this->done_time % 60;
      if ($detik > 0)
        return $menit . ' menit ' . $detik . ' detik';
      return $menit . ' menit';
    }
    return $this->done_time . ' detik';
  }


}
