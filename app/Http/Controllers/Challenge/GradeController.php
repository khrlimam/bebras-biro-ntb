<?php

namespace App\Http\Controllers\Challenge;

use App\Http\Controllers\Controller;
use App\Module;

class GradeController extends Controller
{
  public function module($gradeid)
  {
    $modules = Module::where('grade_id', $gradeid)->orderBy('created_at', 'desc')->paginate(12);
    return view('module.all', compact('modules'));
  }
}
