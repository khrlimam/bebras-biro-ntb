<?php


namespace App\Exceptions;


class SoalHasBeenAnsweredException extends \Exception
{

  public function __construct()
  {
    parent::__construct("Soal telah dijawab", 0, null);
  }

}