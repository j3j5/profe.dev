<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Input;
use Validator;
use Response;
use Asset;
use App\Http\Controllers\Admin\AdminController;
use iansltx\B2Client\Client;
use iansltx\B2Client\Credentials;

class PropuestasController extends AdminController
{
    protected $model;
    public function __construct()
    {
        $this->model = 'propuestas';
        // dd($this->model, __FILE__);
        parent::__construct();
        // if(!app()->environment('production')) {
            // $this->images_base_url = "http://{$_SERVER['HTTP_HOST']}/images/galeria/1/";
        // }
    }

    protected function createAddAssets() {
        parent::createAddAssets();

        $dropzone_options = '
            Dropzone.options.imagesDropzone = {
                init: function() {
                    this.on("success", function(file, responseText) {
                        $("#thumbnail").val(file.name);
                    });
                }
            };
            Dropzone.options.filesDropzone = {
                init: function() {
                    this.on("success", function(file, responseText) {
                        $("#archivo").val(file.name);
                    });
                }
            };
            ';
        Asset::addScript($dropzone_options);
    }

    public function upload(Request $request) {
        $file = array('file' => $request->file('file'));
        $rules = array('file' => 'required',); //mimes:jpeg,bmp,png and for max size max:10000
        $validator = Validator::make($file, $rules);
        if ($validator->fails()) {
            // send back to the page with the input data and errors
            return Response::json(['error' => $validator->errors()], 400);
        } else {
            // checking file is valid.
            if ($request->file('file')->isValid()) {
                $this->handleUpload($request);

                // sending back with message
                return Response::json('success', 200);
            } else {
                // sending back with error message.
                return Response::json(['error' => 'Not a valid file.'], 400);
            }
        }
    }

}
