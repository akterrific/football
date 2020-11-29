<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'FootballController@index')->name('football-index');
Route::get('/match', 'FootballController@match')->name('football-match');
Route::get('/all', 'FootballController@all')->name('football-all');
Route::get('/clear', 'FootballController@clear')->name('football-clear');

