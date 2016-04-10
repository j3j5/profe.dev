<?php

namespace App\Http\Controllers\Admin;

use Asset;

class ConceptosController extends AdminController
{
    protected $model = 'conceptos';

    protected function createAddAssets() {
        parent::createAddAssets();

        view()->share('route', "uploadImage");

        $dropzone_options = '
            Dropzone.options.imagesDropzone = {
                init: function() {
                    this.on("success", function(file, responseText) {
                        $("#thumbnail").val(file.name);
                    });
                }
            };
            ';
        Asset::addScript($dropzone_options);
    }
}
