<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware('auth:api')->group(function () {
  Route::apiResources([
    'posts' => 'API\PostController',
    'users' => 'API\UserController',
    'comments' => 'API\CommentController',
    'albums' => 'API\AlbumController',
    'images' => 'API\ImageController'
]);
});


  //Route::middleware('auth:api')->get('/user', function (Request $request) {
   //return $request->user();
   //});
