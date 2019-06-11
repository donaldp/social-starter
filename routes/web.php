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

Route::middleware('auth')->group(function() {

  Route::get('/', 'HomeController@index');

  // Posts
  Route::post('/post/add', 'PostController@create');
  Route::get('/post/all', 'PostController@all');
  Route::get('/post/fetch', 'PostController@getOlder');

});

Auth::routes();
