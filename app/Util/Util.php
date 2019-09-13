<?php


namespace App\Util;


class Util
{

  public static function redirectIfSucceed($succeed, $next, $success = 'Berhasil menambah data', $fail = 'Terjadi kesalahan')
  {
    if ($succeed)
      return $next($success);
    else return redirect()->back()->withInput()->with('fail', $fail);
  }

  public static function normalizedMd5Answer($string)
  {
    return md5(trim(strtolower(preg_replace('/\s+/', ' ', $string))));
  }

}