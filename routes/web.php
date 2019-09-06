<?php

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->name('admin.')->group(function() {
  Route::resource('soal', 'SoalController');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
