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

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::resource('threads','ThreadsController',['only'=>['index','create','store','edit','update','destroy']]);
Route::get('threads/{channel}/{thread}','ThreadsController@show');
Route::post('/threads/{channel}/{thread}/replies','RepliesController@store');
