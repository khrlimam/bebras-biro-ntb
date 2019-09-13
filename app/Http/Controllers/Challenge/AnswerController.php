<?php

namespace App\Http\Controllers\Challenge;

use App\Answer;
use App\Attempt;
use App\Exceptions\SoalHasBeenAnsweredException;
use App\Http\Controllers\Controller;
use App\Http\Requests\AnswerRequest;
use App\Soal;
use App\Util\Util;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnswerController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    //
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   * @throws SoalHasBeenAnsweredException
   */
  public function store(AnswerRequest $request)
  {
    $validated = $request->validated();
    $attemptId = $validated['attempt_id'];
    $soalId = $validated['soal_id'];
    $this->preventAnswerMoreThanOnce($attemptId, $soalId);
    $soal = Soal::find($validated['soal_id']);
    $isCorrect = Util::normalizedMd5Answer($validated['jawaban']) == $soal->normalizedMd5Answer();
    $validated['correct'] = $isCorrect;
    $created = Answer::create($validated);
    $created['jawaban_benar'] = $created->soal->jawaban;
    return $created;
  }

  /**
   * @param $attemptId
   * @param $soalId
   * @throws SoalHasBeenAnsweredException
   */
  private function preventAnswerMoreThanOnce($attemptId, $soalId)
  {
//    use if check manual, using try catch errors on heroku
    $answeredQuestion = Attempt::where('username', Auth::user()->username)
      ->where('id', $attemptId)->first()->answers
      ->where('soal_id', $soalId)->first();
    if ($answeredQuestion)
      throw new SoalHasBeenAnsweredException();
  }

  /**
   * Display the specified resource.
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    //
  }
}
