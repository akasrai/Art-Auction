<?php
Auth::routes();

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');
Route::get('/faq', 'HomeController@getFAQ');
Route::get('/contact', 'HomeController@getContactInfo');

Route::get('/search', 'SearchProductController@search')->name('product.search');

Route::get('/auction/{productSlug}', 'ProductController@getAuctionBySlug');
Route::get('/product/{productSlug}', 'ProductController@getProductBySlug');
Route::get('/category/{category}', 'ProductController@getByCategory');

Route::get('/add-to-cart/{slug}', 'ProductController@addToCart');
Route::get('/remove-from-cart/{id}', 'ProductController@removeFromCart');
Route::get('/my-cart-items', 'ProductController@getCartItems');

Route::get('/auction', 'ProductController@getAuction');
Route::get('/shop', 'ProductController@getShop');

Route::get('/checkout', 'ProductOrderController@getCheckoutForm');
Route::get('/place-order', 'ProductOrderController@placeOrder');

Route::get('/dashboard', 'DashboardController@index');
Route::get('/biddings', 'DashboardController@getMyBiddings');

Route::get('/profile', 'UserController@index');
Route::get('/my-orders', 'UserController@getOrders');

Route::post('/profile/update', 'UserController@update')->name('profile.update');
Route::post('/address/update', 'UserController@updateAddress');

Route::post('/upload-profile-image', 'UserController@uploadProfileImage');
Route::get('/resend-email-verification-link', 'UserController@resendEmailVerificationLink');

Route::post('/bid/product', 'ProductAuctionController@bidProduct');


Route::post('users/logout', 'Auth\LoginController@userLogout')->name('user.logout');

Route::get('verify/{email}/{verifyToken}', 'Auth\RegisterController@verifyEmail')->name('verifyEmail');

Route::prefix('admin')->group(function () {
    Route::get('/logout', 'Myadmin\LoginController@logout')->name('admin.logout');

    Route::GET('/', 'Myadmin\LoginController@showLoginForm')->name('admin.login');
    Route::POST('/', 'Myadmin\LoginController@login');

    Route::GET('/password/reset', 'Myadmin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::POST('/password/email', 'Myadmin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');

    Route::GET('/password/reset/{token}', 'Myadmin\ResetPasswordController@showResetForm')->name('admin.password.reset');
    Route::POST('/password/reset', 'Myadmin\ResetPasswordController@reset');

    Route::GET('/register', 'Myadmin\RegisterController@showRegistrationForm')->name('admin.register');
    Route::POST('/register', 'Myadmin\RegisterController@register')->name('admin.register.submit');

    Route::GET('/userlist', 'Myadmin\SuperadminController@userlist')->name('admin.userlist');
    Route::GET('/userlist/json', 'Myadmin\SuperadminController@userlistJson');

    Route::get('/article/{id}', 'Myadmin\SuperadminController@singleArticle');
    Route::GET('/dashboard', 'Myadmin\DashboardController@index');

    Route::GET('/category/create', 'Myadmin\CategoryController@index');
    Route::GET('/category/delete/{id}', 'Myadmin\CategoryController@delete');
    Route::POST('/category/create', 'Myadmin\CategoryController@create')->name('admin.category.submit');

    Route::GET('/product/create', 'Myadmin\ProductController@index');
    Route::POST('/product/create', 'Myadmin\ProductController@create')->name('admin.product.submit');
    Route::GET('/product/edit/{slug}', 'Myadmin\ProductController@edit');
    Route::POST('/product/update', 'Myadmin\ProductController@update')->name('admin.product.update');
    Route::GET('/product/delete/{slug}', 'Myadmin\ProductController@delete');

    Route::GET('/auctions', 'Myadmin\ProductAuctionController@auctionList');
    Route::GET('/auctions/{slug}', 'Myadmin\ProductAuctionController@getProductBySlug');

    Route::GET('/end-auctions/{slug}', 'Myadmin\ProductAuctionController@endAuction');
    Route::GET('/email-winner/{id}', 'Myadmin\ProductAuctionController@emailWinner');
});

 //Setting locale
 Route::get('welcome/{locale}', function ($locale) {
     App::setLocale($locale);
 });
