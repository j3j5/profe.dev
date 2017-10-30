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

Route::get('/home', 'HomeController@redirectHome');

// Authentication routes...
Route::auth();

Route::get('sitemap.xml', ['as' => 'sitemap', 'uses' => 'CursosController@sitemap']);
Route::get('sitemap/{format}', ['as' => 'sitemap', 'uses' => 'CursosController@sitemap']);

Route::group(['prefix' => 'admin', 'middleware' => 'auth', 'namespace' => 'Admin'], function () {
    // Admin main page
    Route::get('/', ['as' => 'adminPanel', 'middleware' => 'auth', 'uses' => 'AdminController@defaultAdmin']);

    Route::get('/{modelName}', 'AdminController@index')->name("showModel");

    // API
    Route::group(['prefix' => 'api'], function(){
        Route::get('/{modelName}/table', 'ApiController@getTableValues')->name("getTableValues");
        Route::post('/{modelName}/create', 'ApiController@create')->name("createModel");
        Route::post('/{modelName}/update/{id}', 'ApiController@update')->name("updateModel");
        Route::delete('/{modelName}/delete/{id}', 'ApiController@delete')->name("deleteModel");

        Route::post('/thumb/upload', 'ApiController@thumbUpload')->name("thumbUpload");
        Route::post('/gallery/upload', 'ApiController@galleryUpload')->name("galleryUpload");
        Route::post('/{modelName}/upload', 'ApiController@uploads')->name("uploadRoute");
        Route::post('/{modelName}/bulkUpload', 'ApiController@bulkUpload')->name("bulkUpload");

        Route::get('/grupos', 'ApiController@getGrupoConceptos')->name('getGrupoConceptos');
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
    Route::get('/acreditaciones', ['as' => 'acreditaciones', 'uses' => 'CursosController@getAcreditaciones']);
    Route::get('/prueba', ['as' => 'Prueba', 'uses' => 'CursosController@getPrueba']);
});
// Tests
