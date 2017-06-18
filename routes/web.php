<?php

//

// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('auth.login');
$this->post('login', 'Auth\LoginController@login')->name('auth.login');
$this->post('logout', 'Auth\LoginController@logout')->name('auth.logout');

// Change Password Routes...
$this->get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
$this->patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');
//Front part
//Products
 Route::get('/', ['as'=>'products-index','uses'=>'Front\ProductsController@index']);
 Route::get('/products', ['as'=>'products-catalog','uses'=>'Front\ProductsController@catalog']);
 Route::get('/products/{product}', ['as'=>'products-show','uses'=>'Front\ProductsController@show']);
 
 //News
  Route::get('/news', ['as'=>'news-index','uses'=>'Front\NewsController@index']);
  Route::get('/news/{news}', ['as'=>'news-show','uses'=>'Front\NewsController@show']);
 //Compare system
 Route::get('/compare/add', ['as'=>'products-compare-add','uses'=>'Front\ProductsController@compare_add']);
 Route::get('/compare/del', ['as'=>'products-compare-del','uses'=>'Front\ProductsController@compare_del']);




//Admin part
Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/home', 'HomeController@index');
    Route::resource('roles', 'Admin\RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'Admin\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
    Route::resource('users', 'Admin\UsersController');
    Route::post('users_mass_destroy', ['uses' => 'Admin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);
    //Products
    Route::resource('products', 'Admin\ProductsController');
    Route::post('products_mass_destroy', ['uses' => 'Admin\ProductsController@massDestroy', 'as' => 'products.mass_destroy']);
    Route::get('properties/{product}', ['uses' => 'Admin\ProductsController@createProperties', 'as' => 'products.properties.create']);
    Route::post('properties/{product}', ['uses' => 'Admin\ProductsController@storeProperties', 'as' => 'products.properties.store']);
    //Categories
    Route::resource('categories', 'Admin\CategoriesController');
    Route::post('categories_mass_destroy', ['uses' => 'Admin\CategoriesController@massDestroy', 'as' => 'categories.mass_destroy']);
    
    Route::resource('specifications', 'Admin\SpecificationsController');
    Route::post('specifications_mass_destroy', ['uses' => 'Admin\SpecificationsController@massDestroy', 'as' => 'specifications.mass_destroy']);
    
    Route::post('/spatie/media/upload', 'Admin\SpatieMediaController@create')->name('media.upload');
    Route::post('/spatie/media/remove', 'Admin\SpatieMediaController@destroy')->name('media.remove');
    
    Route::resource('menus', 'Admin\MenusController');
    Route::post('menus_mass_destroy', ['uses' => 'Admin\MenusController@massDestroy', 'as' => 'menus.mass_destroy']);
	
    Route::resource('items', 'Admin\ItemsController');
    Route::post('items_mass_destroy', ['uses' => 'Admin\ItemsController@massDestroy', 'as' => 'items.mass_destroy']);
	
    Route::resource('news', 'Admin\NewsController');
    Route::post('news_mass_destroy', ['uses' => 'Admin\NewsController@massDestroy', 'as' => 'news.mass_destroy']);
    
    Route::resource('pages', 'Admin\PagesController');
    Route::post('pages_mass_destroy', ['uses' => 'Admin\PagesController@massDestroy', 'as' => 'pages.mass_destroy']);
    
    
    Route::resource('banners', 'Admin\BannersController');
    Route::post('banners_mass_destroy', ['uses' => 'Admin\BannersController@massDestroy', 'as' => 'banners.mass_destroy']);
    
    Route::resource('reviews', 'Admin\ReviewsController');
    Route::post('reviews_mass_destroy', ['uses' => 'Admin\ReviewsController@massDestroy', 'as' => 'reviews.mass_destroy']);
   

});
