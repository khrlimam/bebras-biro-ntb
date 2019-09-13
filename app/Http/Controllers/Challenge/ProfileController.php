<?php

namespace App\Http\Controllers\Challenge;

use App\Attempt;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Profile;
use App\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $attempts = Attempt::where('username', Auth::user()->username)->get();
    return view('auth.profile', compact('attempts'));
  }


  /**
   * Show the form for editing the specified resource.
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $user = Auth::user();
    return view('auth.editprofile', compact('user'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function update(ProfileUpdateRequest $request, $id)
  {
    $updated = Profile::where('username', Auth::user()->username)->first()->update($request->validated());
    if ($updated) return redirect()->route('auth.profile.index');
  }

}
