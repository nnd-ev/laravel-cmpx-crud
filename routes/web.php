<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'PagesController@index');
Route::get('about', 'PagesController@about');
Route::get('services', 'PagesController@services');



Route::resource('posts', 'PostsController');
// Route::post('create','PostsController@store'); //ovo se salje sa strane create
// Route::post('posts/update/{id}','PostsController@update'); //ovo se salje sa strane edit
Route::post('posts/delete/{id}','PostsController@destroy'); //ovo se salje sa strane edit
