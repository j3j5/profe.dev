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

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    // Admin main page
    Route::get('/', ['as' => 'adminPanel', 'middleware' => 'auth', function () {
        return redirect()->route("createPropuestas");
    }]);

    // Propuestas
    Route::get('/propuestas/create', [
        'as' => 'createPropuestas', 'uses' => 'Admin\PropuestasController@create'
    ]);
    Route::get('/propuestas/edit/{id}', [
        'as' => 'editPropuestas', 'uses' => 'Admin\PropuestasController@edit'
    ]);
    Route::post('/propuestas/upload', [
        'as' => 'uploadPropuesta', 'uses' => 'Admin\PropuestasController@upload'
    ]);
    Route::post('/propuestas/images/upload', [
        'as' => 'uploadPropuestaImage', 'uses' => 'Admin\PropuestasController@imageUpload'
    ]);

    // Images
    Route::get('/images/create', [
        'as' => 'createImage', 'uses' => 'Admin\ImagesController@create'
    ]);
    Route::get('/images/edit/{id}', [
        'as' => 'editImage', 'uses' => 'Admin\ImagesController@edit'
    ]);
    Route::post('/images/upload', [
        'as' => 'uploadImage', 'uses' => 'Admin\ImagesController@upload'
    ]);
    Route::post('/images/bulk/upload', [
        'as' => 'uploadBulkImages', 'uses' => 'Admin\ImagesController@bulkUpload'
    ]);

});

// Cursos
Route::group(['prefix' => 'curso/{curso}'], function () {

    Route::get('/', ['as' => 'curso', 'uses' => "CursosController@getCurso"]);

    Route::get('/propuestas', ['as' => 'Propuestas', 'uses' => 'CursosController@getPropuestas']);
    Route::get('/galeria', ['as' => 'Gallery', 'uses' => 'CursosController@getImages']);
});
// Tests
