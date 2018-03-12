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

$this->get('call', 'MailController@call_order')->name('mail-call_order');
$this->get('exist', 'MailController@exist_order')->name('mail-exist_order');


//Front part
//Pages
 Route::get('/page/{alias}',  ['as'=>'pages', 'uses'=>'Front\PagesController@page']);
//Products
 Route::get('/', ['as'=>'products-index','uses'=>'Front\ProductsController@index']);
 Route::get('/products', ['as'=>'products-catalog','uses'=>'Front\ProductsController@catalog']);
 Route::get('/products/{product}', ['as'=>'products-show','uses'=>'Front\ProductsController@show']);
 Route::post('/products/review', ['as'=>'products-add-review','uses'=>'Front\ProductsController@review']);
 Route::post('/products/filter', ['as'=>'products-filter','uses'=>'Front\ProductsController@filter']);
 Route::get('/search', ['as'=>'products-search','uses'=>'Front\ProductsController@search']);
 
 //Route::get('/catalog', ['as'=>'products-catalog-alias','uses'=>'Front\ProductsController@alias_filter']);
 Route::post('/catalog/{category_slug?}/{brand_list?}/{custom_slug?}', ['as'=>'products-catalog-human','uses'=>'Front\ProductsController@human_filter']);
 Route::get('/catalog/{category_slug?}/{brand_list?}/{custom_slug?}', ['as'=>'products-catalog-human','uses'=>'Front\ProductsController@human_filter']);
 
 //News
  Route::get('/news', ['as'=>'news-index','uses'=>'Front\NewsController@index']);
  Route::get('/news/{news}', ['as'=>'news-show','uses'=>'Front\NewsController@show']);
  
 //Compare system
 Route::get('/compare', ['as'=>'products-compare','uses'=>'Front\ProductsController@compare']);
 Route::get('/compare/add', ['as'=>'products-compare-add','uses'=>'Front\ProductsController@compare_add']);
 Route::get('/compare/del', ['as'=>'products-compare-del','uses'=>'Front\ProductsController@compare_del']);

//Cart
 Route::get('/cart', ['as'=>'products-cart-index','uses'=>'Front\CartController@index']);
 Route::get('/cart/add', ['as'=>'products-cart-add','uses'=>'Front\CartController@cart_add']);
 Route::get('/cart/del', ['as'=>'products-cart-del','uses'=>'Front\CartController@cart_del']);
 Route::post('/cart', ['as'=>'products-cart-store','uses'=>'Front\CartController@store']);
 Route::get('/cart/edit', ['as'=>'products-cart-edit','uses'=>'Front\CartController@edit']);
 Route::post('/cart/edit/{order}', ['as'=>'products-cart-update','uses'=>'Front\CartController@update']);
 
 //Payments
  Route::get('/payment/start', ['as'=>'payment-start','uses'=>'Front\CartController@start']);
 Route::get('/payment/result', ['as'=>'payment-result','uses'=>'Front\CartController@result']);
 Route::get('/payment/success', ['as'=>'payment-success','uses'=>'Front\CartController@success']);
 Route::get('/payment/fail', ['as'=>'payment-fail','uses'=>'Front\CartController@fail']);
 Route::get('/order/finish', ['as'=>'order-finish','uses'=>'Front\CartController@nokassa_order']);
 

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
    Route::get('products/copy/{product}', ['uses' => 'Admin\ProductsController@copy', 'as' => 'product.copy']);
    //Export products
    Route::get('products/export/yml', ['uses' => 'Admin\YmlController@export_to_yml', 'as' => 'products.export']);
    
    Route::get('products/properties/get', ['uses' => 'Admin\ProductsController@getProperties', 'as' => 'products.properties']);
    
    
    //Categories
    Route::resource('categories', 'Admin\CategoriesController');
    Route::post('category/{$category}',['uses' => 'Admin\CategoriesController@update', 'as' => 'category.update'] );
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
   
    Route::resource('orders', 'Admin\OrdersController');
    Route::post('orders_mass_destroy', ['uses' => 'Admin\OrdersController@massDestroy', 'as' => 'orders.mass_destroy']);
    
     Route::resource('brands', 'Admin\BrandsController');
    Route::post('brands_mass_destroy', ['uses' => 'Admin\BrandsController@massDestroy', 'as' => 'brands.mass_destroy']);

     Route::resource('filters', 'Admin\FiltersController');
    Route::post('filters_mass_destroy', ['uses' => 'Admin\FiltersController@massDestroy', 'as' => 'filters.mass_destroy']);
});
