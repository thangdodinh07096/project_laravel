<?php

	Route::group([
	    'namespace' => 'Backend',
	    'prefix' => 'admin'
	], function (){
	    // Trang dashboard - trang chủ admin
	    Route::get('/dashboard', 'DashboardController@index')->name('backend.dashboard');
	    // Quản lý sản phẩm
	    Route::group(['prefix' => 'products'], function(){
	       Route::get('/', 'ProductController@index')->name('backend.product.index');
	       Route::get('/create', 'ProductController@create')->name('backend.product.create');
	    });
	    //Quản lý người dùng
	    Route::group(['prefix' => 'users'], function(){
	        Route::get('/', 'UserController@index')->name('backend.user.index');
	        Route::get('/create', 'UserController@create')->name('backend.user.create');
	    });
	    //Quản lý danh mục sản phẩm 
	    Route::group(['prefix' => 'categories'], function(){
	        Route::get('/', 'CategoryController@index')->name('backend.categories.index');
	        Route::get('/create', 'CategoryController@create')->name('backend.categories.create');
	    });
	});
