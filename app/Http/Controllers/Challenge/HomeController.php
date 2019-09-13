<?php

namespace App\Http\Controllers\Challenge;

use App\Grade;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('auth');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index()
  {
    $sd = Grade::where('grade', 'SD')->first()->modules()->orderBy('created_at', 'desc')->limit(8)->get();
    $smp = Grade::where('grade', 'SMP')->first()->modules()->orderBy('created_at', 'desc')->limit(8)->get();
    $sma = Grade::where('grade', 'SMA')->first()->modules()->orderBy('created_at', 'desc')->limit(8)->get();
    return view('home', compact('sd', 'smp', 'sma'));
  }

}
