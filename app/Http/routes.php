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

    // Images
    Route::get('/images', [
        'as' => 'adminImages', 'uses' => 'Admin\ImagesController@index'
    ]);

    Route::get('/images/create', [
        'as' => 'createImage', 'uses' => 'Admin\ImagesController@create'
    ]);
    Route::get('/images/edit/{id}', [
        'as' => 'editImage', 'uses' => 'Admin\ImagesController@edit'
    ]);
    Route::post('/images/gallery/upload', [
        'as' => 'uploadGalleryImage', 'uses' => 'Admin\ImagesController@upload'
    ]);
    Route::post('/images/gallery/bulk/upload', [
        'as' => 'uploadBulkImages', 'uses' => 'Admin\ImagesController@bulkUpload'
    ]);

    // Conceptos
    Route::get('/conceptos', [
        'as' => 'adminConceptos', 'uses' => 'Admin\ConceptosController@index'
    ]);
    Route::get('/conceptos/create', [
        'as' => 'createConcepto', 'uses' => 'Admin\ConceptosController@create'
    ]);
    Route::get('/conceptos/edit/{id}', [
        'as' => 'editConcepto', 'uses' => 'Admin\ConceptosController@edit'
    ]);

    // Megustas
    Route::get('/me_gustas', [
        'as' => 'adminMegustas', 'uses' => 'Admin\MegustasController@index'
    ]);
    Route::get('/me_gustas/create', [
        'as' => 'createMeGusta', 'uses' => 'Admin\MegustasController@create'
    ]);
    Route::get('/me_gustas/edit/{id}', [
        'as' => 'editMegusta', 'uses' => 'Admin\MegustasController@edit'
    ]);

    // Examenes
    Route::get('/examens/create', [
        'as' => 'createExamenes', 'uses' => 'Admin\ExamenesController@create'
    ]);
    Route::get('/examens/edit/{id}', [
        'as' => 'editExamenes', 'uses' => 'Admin\ExamenesController@edit'
    ]);
    Route::post('/examens/upload', [
        'as' => 'uploadExamen', 'uses' => 'Admin\ExamenesController@upload'
    ]);

    // Misc
    Route::post('/images/upload', [
        'as' => 'uploadImage', 'uses' => 'Admin\AdminController@imageUpload'
    ]);

    Route::get('/{modelName}', 'Admin\MainController@index');
    Route::get('/{modelName}/create', 'Admin\MainController@create');
    Route::get('/{modelName}/edit/{id}', 'Admin\MainController@edit');
    Route::put('/{modelName}/{id}', 'Admin\MainController@update');
    Route::post('/{modelName}', 'Admin\MainController@store');
    Route::get('/{modelName}/delete/{id}', 'Admin\MainController@delete');

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
