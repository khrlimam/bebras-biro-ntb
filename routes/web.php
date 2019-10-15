<?php

Route::get('/', function () {
  return view('welcome');
});

Route::prefix('admin')->name('admin.')->namespace('Admin')->group(function () {
  Route::view('/', 'admin.dashboard')->name('dashboard');
  Route::get('soal/create/{moduleid}', 'SoalController@create')->name('soal.create');
  Route::resource('soal', 'SoalController')->except('create');
  Route::resource('module', 'ModuleController')->except('show');
  Route::get('module/{id}/attempts', 'ModuleController@attempts')->name('module.attempts');
  Route::get('tantangan/{moduleid}/soal', 'ModuleController@showSoal')->name('module.soal.show');
  Route::resource('grade', 'GradeController');
  Route::resource('user', 'UserController');
  Route::resource('school', 'SchoolController');
});

Route::name('auth.')->namespace('Challenge')->middleware('auth')->group(function () {
  Route::get('home', 'HomeController@index')->name('home');
  Route::resource('profile', 'ProfileController')->except(['post', 'create', 'destroy', 'store']);
  Route::get('grade/{gradeid}/module', 'GradeController@module')->name('grade.module.all');
  Route::get('tantangan/{moduleid}', 'ModuleController@show')->name('module.show');
  Route::resource('attempt', 'AttemptController');
  Route::get('attempt/{id}/nextquestion/', 'AttemptController@getNextQuestion')->name('attempt.nextquestion');
  Route::get('attempt/{id}/{position}', 'AttemptController@getAttemptQuestionAt')->name('attempt.question_at');
  Route::get('attempt/{id}/review/_', 'AttemptController@review')->name('attempt.review');
  Route::post('attempt/done', 'AttemptController@done')->name('attempt.done');
  Route::resource('answer', 'AnswerController');
});

Auth::routes();
