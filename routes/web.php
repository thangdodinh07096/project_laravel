<?php

	Route::group([
	    'namespace' => 'Backend',
	    'prefix' => 'admin',
	    'middleware' => 'auth'
	], function (){
	    // Trang dashboard - trang chủ admin
	    Route::get('/dashboard', 'DashboardController@index')->name('backend.dashboard');
	    // Quản lý sản phẩm
	    Route::group(['prefix' => 'products'], function(){
            Route::get('/', 'ProductController@index')->name('backend.product.index');
            Route::get('/show/{id?}', 'ProductController@show')->name('backend.product.show');
            Route::get('/create', 'ProductController@create')->name('backend.product.create');
            Route::post('/', 'ProductController@store')->name('backend.product.store');
            Route::get('/edit/{id?}', 'ProductController@edit')->name('backend.product.edit');
            Route::put('/update/{id?}', 'ProductController@update')->name('backend.product.update');
            Route::delete('/destroy/{id?}', 'ProductController@destroy')->name('backend.product.destroy');
        });
	    //Quản lý người dùng
	    Route::group(['prefix' => 'users'], function(){
	        Route::get('/', 'UserController@index')->name('backend.user.index');
	        Route::get('/create', 'UserController@create')->name('backend.user.create');
	    });
	    //Quản lý danh mục sản phẩm
	    Route::group(['prefix' => 'categories'], function(){
	        Route::get('/', 'CategoryController@index')->name('backend.category.index');
	        Route::get('/show/{id?}', 'CategoryController@show')->name('backend.category.show');
	        Route::get('/create', 'CategoryController@create')->name('backend.category.create');
	        Route::post('/', 'CategoryController@store')->name('backend.category.store');
	        Route::get('/edit/{id?}', 'CategoryController@edit')->name('backend.category.edit');
            Route::put('/update/{id?}', 'CategoryController@update')->name('backend.category.update');
            Route::delete('/destroy/{id?}', 'CategoryController@destroy')->name('backend.category.destroy');
	    });

	});

	Route::group([
	    'namespace' => 'Frontend',
	    'prefix' => 'online'
	], function (){
	    Route::get('/index', 'IndexController@index')->name('frontend.index');
	    Route::group(['prefix' => 'products'], function(){
	       Route::get('/', 'ProductController@index')->name('frontend.product.index');
	    });
	    Route::group(['prefix' => 'shop'], function(){
	        Route::get('/', 'ShopController@index')->name('frontend.shop');
	    });
	    //Quản lý danh mục sản phẩm
	    Route::group(['prefix' => 'cart'], function(){
	        Route::get('/', 'CartController@index')->name('frontend.cart');
	    });
	    Route::group(['prefix' => 'contact'], function(){
	        Route::get('/', 'ContactController@index')->name('frontend.contact');
	    });
	});

Auth::routes();
// Route::get('/auth/login', 'LoginController@index')->name('auth.login');
// Route::get('/', 'LoginController@logout')->name('auth.logout');
Route::get('/home', 'HomeController@index')->name('home');
