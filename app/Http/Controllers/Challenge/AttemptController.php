<?php

namespace App\Http\Controllers\Challenge;

use App\Answer;
use App\Attempt;
use App\Http\Controllers\Controller;
use App\Http\Requests\AttemptDoneRequest;
use App\Http\Requests\AttemptRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttemptController extends Controller
{

  public function __construct()
  {
    $this->middleware('relateduser')->only(['review', 'done']);
  }

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
   */
  public function store(AttemptRequest $request)
  {
    $validated = $request->validated();
    $validated['username'] = Auth::user()->username;
    $created = Attempt::create($validated);
    return redirect()->route('auth.attempt.show', $created->id);
  }

  /**
   * Display the specified resource.
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $attempt = Attempt::find($id);
    if ($attempt->done) return redirect()->route('auth.attempt.review', $attempt->id);
    $width = 100 / $attempt->module->soals->count();
    $soal = $this->getNextQuestion($id);
    $userAnswers = $this->getUserAnswers($attempt->id)->groupBy('soal_id')->all();
    return view('attempt.show', compact('attempt', 'soal', 'width', 'userAnswers'));
  }

  private function getUserAnswers($attemptId)
  {
    return Attempt::where('username', Auth::user()->username)
      ->where('id', $attemptId)->first()->answers;
  }

  public function getNextQuestion($id)
  {
    //    use if check manual, using try catch errors on heroku
    $soal = $this->getUnAnsweredQuery($id)->first();
    if (!$soal) {
      $attempt = Attempt::find($id);
      $attempt->done = true;
      $attempt->save();
      $soal = $this->getAttemptQuestionAt($id, 0);
      $soal['all'] = true;
    }
    $soal->pilihans;
    return $soal;
  }

  public function getAttemptQuestionAt($id, $position)
  {
    $attempt = Attempt::find($id);
    $soal = $attempt->module->soals->get($position);
    return $soal;
  }

  private function getUnAnsweredQuery($id)
  {
    $attempt = Attempt::find($id);
    return $attempt->module->soals
      ->whereNotIn('id', Answer::where('attempt_id', $attempt->id)->get('soal_id')->map(function ($item) {
        return $item['soal_id'];
      })->toArray());
  }

  public function review($id)
  {
    $attempt = Attempt::find($id);
    $correctAnswers = $attempt->answers->filter(function ($item) {
      return $item->correct;
    })->count();
    $score = $correctAnswers / $attempt->module->soals->count() * 100;
    $attempt['answers'] = $attempt->answers->groupBy(function ($item) {
      return $item['soal_id'];
    });
    return view('attempt.review', compact('attempt', 'score'));
  }

  public function done(AttemptDoneRequest $request)
  {
    $validated = $request->validated();
    $updated = Attempt::find($validated['attempt_id'])->update(['done' => true]);
    if ($updated)
      return redirect()->route('auth.attempt.review', $validated['attempt_id']);
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
