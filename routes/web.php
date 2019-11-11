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
            Route::get('/show/{id?}', 'UserController@show')->name('backend.user.show');
	        Route::get('/create', 'UserController@create')->name('backend.user.create');
            Route::post('/', 'UserController@store')->name('backend.user.store');
            Route::get('/edit/{id?}', 'UserController@edit')->name('backend.user.edit');
            Route::put('/update/{id?}', 'UserController@update')->name('backend.user.update');
            Route::delete('/destroy/{id?}', 'UserController@destroy')->name('backend.user.destroy');
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
	    Route::group(['prefix' => 'index'], function(){
	       Route::get('/', 'IndexController@index')->name('frontend.index');

	    });
	    Route::group(['prefix' => 'shop'], function(){
	        Route::get('/', 'ShopController@index')->name('frontend.shop');
	    });
	    //Quản lý danh mục sản phẩm
	    Route::group(['prefix' => 'cart'], function(){
	        Route::get('/', 'CartController@index')->name('frontend.cart.index');
	        Route::get('/add/{id}', 'CartController@add')->name('frontend.cart.add');
	    });
	    Route::group(['prefix' => 'contact'], function(){
	        Route::get('/', 'ContactController@index')->name('frontend.contact');
	    });
	});

    Auth::routes();
     Route::get('/auth/logout', 'LoginController@logout')->name('auth.logout');
    // Route::get('/', 'LoginController@logout')->name('auth.logout');
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('set', 'SessionController@set');
    Route::get('get', 'SessionController@get');
    Route::get('get2', 'SessionController@get2');
    Route::get('setCookie', 'CookieController@set');
    Route::get('getCookie', 'CookieController@get');

    Route::get('/home/index', 'HomeController@index')->name('home');
