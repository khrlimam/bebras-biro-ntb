<?php

namespace App\Http\Controllers\Challenge;

use App\Http\Controllers\Controller;
use App\Module;

class ModuleController extends Controller
{
  public function show($moduleid)
  {
    $module = Module::find($moduleid);
    return view('module.show', compact('module'));
  }
}
