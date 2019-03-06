<?php
Route::get('/', function () {
    return view('welcome');
});
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::post('users/logout', 'Auth\LoginController@userLogout')->name('user.logout');
Route::get('admin/logout', 'Myadmin\LoginController@logout')->name('admin.logout');

Route::GET('admin', 'Myadmin\LoginController@showLoginForm')->name('admin.login');
Route::POST('admin', 'Myadmin\LoginController@login');

Route::POST('admin/password/email', 'Myadmin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');

Route::GET('admin/password/reset', 'Myadmin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');

Route::POST('admin/password/reset', 'Myadmin\ResetPasswordController@reset');

Route::GET('admin/password/reset/{token}', 'Myadmin\ResetPasswordController@showResetForm')->name('admin.password.reset');

Route::GET('admin/register', 'Myadmin\RegisterController@showRegistrationForm')->name('admin.register');
Route::POST('admin/register', 'Myadmin\RegisterController@register')->name('admin.register.submit');

Route::GET('admin/userlist', 'Myadmin\SuperadminController@userlist')->name('admin.userlist');
Route::GET('admin/userlist/json', 'Myadmin\SuperadminController@userlistJson');

//Test route
Route::GET('admin/test', 'Myadmin\ModeratorController@test');

//user verification
Route::get('verify-email-first', 'Auth\RegisterController@veryEmailFirst')->name('verifyEmailFirst');

Route::get('verify/{email}/{verifyToken}', 'Auth\RegisterController@sendEmailDone')->name('sendEmailDone');

//for article
Route::get('admin/article/{id}', 'Myadmin\SuperadminController@singleArticle');

//blog controller
Route::resource('/admin/blog', 'Myadmin\BlogController');

//superadmin admin editor moderator routes
 Route::prefix('admin')->group(function () {
     Route::GET('/dashboard', 'Myadmin\DashboardController@index');
     Route::GET('/category/create', 'Myadmin\CategoryController@index');
     Route::POST('/category/create', 'Myadmin\CategoryController@create')->name('admin.category.submit');
     Route::GET('/product/create', 'Myadmin\ProductController@index');
     Route::GET('/products', 'Myadmin\ProductController@create');
 });

 //Setting locale
 Route::get('welcome/{locale}', function ($locale) {
     App::setLocale($locale);
 });
