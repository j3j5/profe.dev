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
Auth::routes();

Route::get('sitemap.xml', ['as' => 'sitemap', 'uses' => 'CursosController@sitemap']);
Route::get('sitemap/{format}', ['as' => 'sitemap', 'uses' => 'CursosController@sitemap']);

// Cursos
Route::group(['prefix' => 'curso/{curso}'], function () {

    Route::get('/', ['as' => 'curso', 'uses' => "CursosController@getCurso"]);

    Route::get('/propuestas', ['as' => 'Propuestas', 'uses' => 'CursosController@getPropuestas']);
    Route::get('/galeria', ['as' => 'Gallery', 'uses' => 'CursosController@getImages']);
    Route::get('/glosario', ['as' => 'Glossary', 'uses' => 'CursosController@getGlosario']);
    Route::get('/megusta', ['as' => 'Megustas', 'uses' => 'CursosController@getLikes']);
    Route::get('/examenes', ['as' => 'Examenes', 'uses' => 'CursosController@getExamenes']);
    Route::get('/acreditaciones', ['as' => 'acreditaciones', 'uses' => 'CursosController@getAcreditaciones']);
});
// Tests
