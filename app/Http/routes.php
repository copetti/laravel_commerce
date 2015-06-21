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

//Route::group(['prefix'=>'admin'], function(){

    Route::get('categories',['as'=>'categories', 'uses'=>'CategoriesController@index']);
    Route::get('categories/create',['as'=>'categories.create', 'uses'=>'CategoriesController@create']);
    Route::post('categories',['as'=>'categories.store', 'uses'=>'CategoriesController@store']);
    Route::get('categories/{id}/edit',['as'=>'categories.edit', 'uses'=>'CategoriesController@edit']);
    Route::put('categories/{id}/update',['as'=>'categories.update', 'uses'=>'CategoriesController@update']);
    Route::get('categories/{id}/destroy',['as'=>'categories.destroy', 'uses'=>'CategoriesController@destroy']);

    Route::get('products',['as'=>'products', 'uses'=>'ProductsController@index']);
    Route::get('products/create',['as'=>'products.create', 'uses'=>'ProductsController@create']);
    Route::post('products',['as'=>'products.store', 'uses'=>'ProductsController@store']);
    Route::get('products/{id}/edit',['as'=>'products.edit', 'uses'=>'ProductsController@edit']);
    Route::put('products/{id}/update',['as'=>'products.update', 'uses'=>'ProductsController@update']);
    Route::get('products/{id}/destroy',['as'=>'products.destroy', 'uses'=>'ProductsController@destroy']);

//});

Route::get('/', 'WelcomeController@index');
Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
