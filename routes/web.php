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

Route::get('/', 'PostController@index')->name('top');

Route::put('users', 'UserController@update');
Route::get('users/confirm', 'UserController@confirm');

Route::get('/posts/search', 'PostController@search')->name('posts.search');

Auth::routes();

Route::resource('posts', 'PostController')->only(['create', 'store', 'show', 'edit', 'update', 'destroy']);
Route::resource('users', 'UserController')->only(['show', 'edit', 'destroy']);
Route::resource('likes', 'LikeController')->only(['index']);
Route::resource('meals', 'MealController')->only(['create', 'store', 'destroy']);
Route::resource('comments', 'CommentController')->only(['store', 'destroy']);
Route::resource('body_values', 'BodyValueController')->only(['store', 'destroy']);