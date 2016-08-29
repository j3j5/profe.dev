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
Route::auth();

Route::get('sitemap.xml', ['as' => 'sitemap', 'uses' => 'CursosController@sitemap']);
Route::get('sitemap/{format}', ['as' => 'sitemap', 'uses' => 'CursosController@sitemap']);

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    // Admin main page
    Route::get('/', ['as' => 'adminPanel', 'middleware' => 'auth', function () {
        return redirect(url('/admin/propuestas'));
    }]);

    Route::get('/{modelName}', 'Admin\AdminController@index')->name("showModel");

    // API
    Route::group(['prefix' => 'api'], function(){
        Route::get('/{modelName}/table', 'Admin\ApiController@getTableValues')->name("getTableValues");
        Route::post('/{modelName}/create', 'Admin\ApiController@create')->name("createModel");
        Route::post('/{modelName}/update/{id}', 'Admin\ApiController@update')->name("updateModel");
        Route::delete('/{modelName}/delete/{id}', 'Admin\ApiController@delete')->name("deleteModel");

        Route::post('/thumb/upload', 'Admin\ApiController@thumbUpload')->name("thumbUpload");
        Route::post('/gallery/upload', 'Admin\ApiController@galleryUpload')->name("galleryUpload");
        Route::post('/{modelName}/upload', 'Admin\ApiController@uploads')->name("uploadRoute");
    });
});

// Cursos
Route::group(['prefix' => 'curso/{curso}'], function () {

    Route::get('/', ['as' => 'curso', 'uses' => "CursosController@getCurso"]);

    Route::get('/propuestas', ['as' => 'Propuestas', 'uses' => 'CursosController@getPropuestas']);
    Route::get('/galeria', ['as' => 'Gallery', 'uses' => 'CursosController@getImages']);
    Route::get('/glosario', ['as' => 'Glossary', 'uses' => 'CursosController@getGlosario']);
    Route::get('/megusta', ['as' => 'Megustas', 'uses' => 'CursosController@getLikes']);
    Route::get('/examenes', ['as' => 'Examenes', 'uses' => 'CursosController@getExamenes']);
});
// Tests
