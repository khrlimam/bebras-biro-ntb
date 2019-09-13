<?php

namespace App\Http\Middleware;

use App\Attempt;
use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;

class OnlyRelatedUser
{
  /**
   * Handle an incoming request.
   *
   * @param \Illuminate\Http\Request $request
   * @param \Closure $next
   * @return mixed
   */
  public function handle($request, Closure $next, Guard $guard = null)
  {
    switch ($request->method()) {
      case 'GET':
        $attemptId = $request->route('id');
        break;
      case  'POST':
        $attemptId = $request->post('attempt_id');
        break;
    }
    $attempt = Attempt::find($attemptId);
    $valid = $attempt->username == Auth::user()->username;
    if (!$valid) abort(404, "Anda tidak diizinkan akses halaman ini");
    return $next($request);
  }
}
