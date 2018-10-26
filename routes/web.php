<?php
use App\Http\Controllers\GoalController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('goals', 'GoalsController');
Route::resource('milestones', 'MilestonesController');
Route::resource('notes', 'NotesController');
