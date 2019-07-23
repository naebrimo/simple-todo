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
    Route::match(['get', 'post', 'patch', 'delete'], '/todo/confirm/{id?}', 'TodoController@confirm')->name('todo.confirm');
    Route::get('/todo/complete', 'TodoController@complete')->name('todo.complete');
    Route::resource('/todo', 'TodoController');
});

Route::prefix('admin')->group(function() {
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login');
    Route::match(['get', 'post'], '/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
    Route::get('/', 'AdminController@index')->name('admin');

    Route::get('/todo/search', 'UserController@search')->name('user.search');
    Route::get('/todo/sort', 'UserController@sort')->name('user.sort');
    Route::match(['get', 'post', 'patch', 'delete'], '/user/confirm/{id?}', 'TodoController@confirm')->name('user.confirm');
    Route::get('/user/complete', 'UserController@complete')->name('user.complete');
    Route::resource('/user', 'UserController');

});
