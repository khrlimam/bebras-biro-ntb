<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
  protected $guarded = ['id'];

  public function attempt()
  {
    return $this->belongsTo(Attempt::class, 'attempt_id');
  }

  public function soal()
  {
    return $this->belongsTo(Soal::class, 'soal_id');
  }

  protected $casts = [
    'correct' => 'boolean'
  ];

}
