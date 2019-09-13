<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attempt extends Model
{

  protected $guarded = ['id'];

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

  public function doneTime()
  {
    return $this->updated_at->diffInSeconds($this->created_at);
  }

  public function doneTimeHumanDescription()
  {
    if ($this->doneTime() / 60 > 1) {
      $menit = round($this->doneTime() / 60);
      $detik = $this->doneTime() % 60;
      if ($detik > 0)
        return $menit . ' menit ' . $detik . ' detik';
      return $menit . ' menit';
    }
    return $this->doneTime() . ' detik';
  }


}
