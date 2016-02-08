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

Route::get('/', ['as' => 'Home', 'uses' => 'HomeController@index']);

Route::get('/home', function () {
    return redirect('/');
});

// Authentication routes...
Route::get('auth/login', ['as' => 'loginView', 'uses' => 'Auth\AuthController@getLogin']);
Route::post('auth/login', ['as' => 'loginPost', 'uses' => 'Auth\AuthController@postLogin']);
Route::get('auth/logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@getLogout']);

// Propuestas routes
Route::get('admin/propuestas/create', ['as' => 'createPropuestas', 'uses' => 'PropuestasController@create']);
Route::post('propuestas/upload', ['as' => 'uploadPropuesta', 'uses' => 'PropuestasController@upload']);
Route::post('propuestas/images/upload', ['as' => 'uploadPropuestaImage', 'uses' => 'PropuestasController@imageUpload']);

// Tests
