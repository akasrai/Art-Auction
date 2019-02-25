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

Route::middleware('auth:api')->get('/admin', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->group(function() {
	Route::get('/posts/unique','Myadmin\BlogController@apiCheckUnique')->name('api.posts.unique');
});


//Articles rest api link
Route::get('admin/articles','Myadmin\ArticleController@index');
Route::get('admin/article/{id}','Myadmin\ArticleController@show');
Route::post('admin/article','Myadmin\ArticleController@store');
Route::put('admin/article','Myadmin\ArticleController@store');
Route::delete('admin/article/{id}','Myadmin\ArticleController@destroy');