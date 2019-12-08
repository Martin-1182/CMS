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

// auth
Auth::routes(['verify' => true]);
Route::get('/admin', 'HomeController@index')->name('admin')->middleware('auth', 'admin');

// users
Route::resource('/admin/users', 'Admin\UserController', ['exept' => ['show', 'create', 'store']]);

// routes
Route::get('/', 'PagesController@home');
Route::get('/posts', 'PostController@index');

// posts
Route::resource('posts', 'PostController');

// comments
Route::resource('comments', 'CommentController');

// albums
Route::resource('albums', 'AlbumController');

// images
Route::resource('images', 'ImageController');

// admin
Route::group(['middleware' => ['auth', 'admin']], function () {

    Route::get('/admin{any?}', function () {
        return view('layouts.admin');
        })->where('any', '.*'); 

});


