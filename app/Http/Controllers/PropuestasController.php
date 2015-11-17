<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Input;
use Validator;
use Response;
use Asset;

use App\Http\Controllers\Controller;

class PropuestasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->createAddAssets();
        $parent_view = app()->make('VivifyIdeas\AdminPanelGenerator\Http\Controllers\MainController')->callAction('create', ['propuestas']);
        $data = $parent_view->getData();
        return view('admin.propuestas', $data);
    }

    private function createAddAssets() {
        Asset::add('css/dropzone/dropzone.min.css');
        Asset::add('//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js', 'footer');
        Asset::add('js/dropzone/dropzone.min.js', 'footer');

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

    public function imageUpload() {
        $file = array('file' => Input::file('file'));
        $rules = array('file' => 'required|mimes:jpg,jpeg,bmp,png',); //mimes:jpeg,bmp,png and for max size max:10000
        $validator = Validator::make($file, $rules);
        if ($validator->fails()) {
            // send back to the page with the input data and errors
            return Response::json(['validationError' => $validator->errors()], 400);
        }
        else {
            // checking file is valid.
            if (Input::file('file')->isValid()) {
                $destination_path = 'uploads'; // upload path
                $filename = Input::file('file')->getClientOriginalName();

                Input::file('file')->move($destination_path, $filename); // uploading file to given path

                // sending back with message
                return Response::json('success', 200);
            } else {
                // sending back with error message.
                return Response::json(['error' => 'Not a valid file.'], 400);
            }
        }
    }

    public function upload() {
        $file = array('file' => Input::file('file'));
        $rules = array('file' => 'required',); //mimes:jpeg,bmp,png and for max size max:10000
        $validator = Validator::make($file, $rules);
        if ($validator->fails()) {
            // send back to the page with the input data and errors
            return Response::json(['error' => $validator->errors()], 400);
        } else {
            // checking file is valid.
            if (Input::file('file')->isValid()) {
                $destination_path = 'uploads'; // upload path

                Input::file('file')->move($destination_path, Input::file('file')->getClientOriginalName()); // uploading file to given path

                // sending back with message
                return Response::json('success', 200);
            } else {
                // sending back with error message.
                return Response::json(['error' => 'Not a valid file.'], 400);
            }
        }
    }

}
