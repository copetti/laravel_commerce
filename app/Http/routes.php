<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::pattern('id','[0-9]+');

Route::group(['prefix'=>'admin'], function(){

    Route::get('categories', function(\CodeCommerce\Category $category){
        return $category->all();
    });

    Route::get('categories/insert','ExemploController@insert');
    Route::get('categories/update/{id}','ExemploController@update');
    Route::get('categories/delete/{id}','ExemploController@delete');

    Route::get('products', function(\CodeCommerce\Product $product){
        return $product->all();
    });

    Route::get('products/insert','ExemploController@insert');
    Route::get('products/update/{id}','ExemploController@update');
    Route::get('products/delete/{id}','ExemploController@delete');
});

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
