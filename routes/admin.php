<?php

// Admin main page
Route::get('/',  'AdminController@defaultAdmin')->name('adminPanel');

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
