<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Input;
use Validator;
use Response;
use Asset;
use App\Models\Image;

class MegustasController extends AdminController
{

    protected $model = 'me_gustas';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->createAddAssets();
        return parent::index($request);
    }

    public function edit($id, Request $request)
    {
        $this->createAddAssets();
        return parent::edit($id, $request);
    }

    public function create(Request $request)
    {
        $this->createAddAssets();
        return parent::create($request);
    }

        protected function createAddAssets() {
        parent::createAddAssets();

        view()->share('route', "uploadImage");

        $dropzone_options = '
            Dropzone.options.imagesDropzone = {
                init: function() {
                    this.on("success", function(file, responseText) {
                        $("#imagen").val(file.name);
                    });
                }
            };
            ';
        Asset::addScript($dropzone_options);
    }

}
