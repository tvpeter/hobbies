<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();
Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Route::get('/hobby/create', 'HobbyController@create')->middleware('verified');
Route::post('/hobby/create', 'HobbyController@store')->middleware('verified');
Route::get('/hobby/delete', 'HobbyController@destroy');
Route::get('/hobby/edit', 'HobbyController@update');

Route::get('/', function () {
    return view('welcome');
});