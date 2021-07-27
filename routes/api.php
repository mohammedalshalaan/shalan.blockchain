<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Blog;
use App\Post;
use App\User;
use App\Comment;


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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::get('posts', 'PostController@apiIndex',function( post $post){
  //  return $post->comments();
//})->name('api.posts.index');

Route::get('posts', 'PostController@apiIndex')->name('api.posts.index');

Route::post('posts', 'PostController@apiStore')->name('api.posts.store');