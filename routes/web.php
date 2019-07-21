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

Auth::routes(['register' => FALSE]);
Route::prefix('/home')->group(function(){
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/todo/search', 'TodoController@search')->name('todo.search');
    Route::get('/todo/sort', 'TodoController@sort')->name('todo.sort');
    Route::match(['get','post'], '/todo/create/confirm', 'TodoController@confirm')->name('todo.confirm');
    Route::get('/todo/create/complete', 'TodoController@complete')->name('todo.complete');
    Route::resource('/todo', 'TodoController');

});
