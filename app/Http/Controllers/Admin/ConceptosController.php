<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Asset;

class ConceptosController extends AdminController
{
    protected $model = 'conceptos';

    public function index(Request $request)
    {
        $parent_view = app()->make('VivifyIdeas\AdminPanelGenerator\Http\Controllers\MainController')->callAction('index', [$this->model, $request]);
        $data = $parent_view->getData();

        return view("admin.conceptos.index", $data);
    }

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
