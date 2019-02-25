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

Route::get('/home', 'HomeController@index')->name('home');

// for admin routes
// Route::prefix('admin')->group(function(){

// 	// login logout register and dashboard routes
// 	Route::get('/home','AdminController@index');

// 	Route::get('/login', 'Myadmin\LoginController@showLoginForm')->name('admin.login');
// 	Route::post('/login', 'Myadmin\LoginController@login')->name('admin.login.submit');
// });

Route::post('users/logout','Auth\LoginController@userLogout')->name('user.logout');
Route::get('admin/logout','Myadmin\LoginController@logout')->name('admin.logout');


Route::GET('admin','Myadmin\LoginController@showLoginForm')->name('admin.login');
Route::POST('admin','Myadmin\LoginController@login');

Route::POST('admin/password/email','Myadmin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');

Route::GET('admin/password/reset','Myadmin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');

Route::POST('admin/password/reset','Myadmin\ResetPasswordController@reset');

Route::GET('admin/password/reset/{token}','Myadmin\ResetPasswordController@showResetForm')->name('admin.password.reset');

Route::GET('admin/register','Myadmin\RegisterController@showRegistrationForm')->name('admin.register');
Route::POST('admin/register','Myadmin\RegisterController@register')->name('admin.register.submit');

Route::GET('admin/userlist','Myadmin\SuperadminController@userlist')->name('admin.userlist');
Route::GET('admin/userlist/json','Myadmin\SuperadminController@userlistJson');



//superadmin admin editor moderator routes
Route::GET('admin/superadmin-dashboard','Myadmin\SuperadminController@index');
Route::GET('admin/admin-dashboard','Myadmin\AdminController@index');
Route::GET('admin/editor-dashboard','Myadmin\EditorController@index');
Route::GET('admin/moderator-dashboard','Myadmin\ModeratorController@index');

Route::GET('admin/test','Myadmin\ModeratorController@test');

//user verification
Route::get('verify-email-first','Auth\RegisterController@veryEmailFirst')->name('verifyEmailFirst');

Route::get('verify/{email}/{verifyToken}','Auth\RegisterController@sendEmailDone')->name('sendEmailDone');

//for article
Route::get('admin/article/{id}','Myadmin\SuperadminController@singleArticle');

//blog controller

Route::resource('/admin/blog','Myadmin\BlogController');