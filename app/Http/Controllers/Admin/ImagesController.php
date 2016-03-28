<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Input;
use Validator;
use Response;
use Asset;
use App\Http\Controllers\Controller;
use iansltx\B2Client\Client;
use iansltx\B2Client\Credentials;

class ImagesController extends Controller
{

    private $b2client;

    public function __construct() {
        $this->b2client = new Client(new Credentials(config('b2client.account_id'), config('b2client.app_key')));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->createAddAssets();
        $parent_view = app()->make('VivifyIdeas\AdminPanelGenerator\Http\Controllers\MainController')->callAction('create', ['images']);
        $data = $parent_view->getData();
        return view('admin.create-images', $data);
    }

    public function edit($id, Request $request)
    {
        $this->createAddAssets();
        $parent_view = app()->make('VivifyIdeas\AdminPanelGenerator\Http\Controllers\MainController')->callAction('edit', ['images', $id]);
        $data = $parent_view->getData();
        return view('admin.edit-images', $data);
    }

    public function upload(Request $request) {
        $file = array('file' => $request->file('file'));
        $rules = array('file' => 'required|mimes:jpg,jpeg,bmp,png',); //mimes:jpeg,bmp,png and for max size max:10000
        $validator = Validator::make($file, $rules);
        if ($validator->fails()) {
            // send back to the page with the input data and errors
            return Response::json(['validationError' => $validator->errors()], 400);
        }
        else {
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

    public function bulkUpload(Request $request) {
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

    /**
     * Move the uploaded file to a desired destination, CDN on production, uploads folder on dev.
     */
    private function handleUpload(Request $request)
    {
        $destination_path = 'images/galeria/' . $request->get("curso"); // upload path
        $filename = $request->file('file')->getClientOriginalName();

        if(app()->environment('production')) {
            $response = $this->b2client->uploadContents(
                config('b2client.bucket_id'),
                "$destination_path/$filename",
                file_get_contents($request->file('file')->getRealPath())
            );

            unlink($request->file('file')->getRealPath());
        } else {
            $request->file('file')->move($destination_path, $filename); // uploading file to given path
        }
    }

    private function createAddAssets() {
        Asset::add('css/dropzone/dropzone.min.css');
        Asset::add('//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js', 'footer');
        Asset::add('js/dropzone/dropzone.min.js', 'footer');

        $dropzone_options = '
            Dropzone.options.imagesDropzone = {
                init: function() {
                    this.on("success", function(file, responseText) {
                        $("#nombre-archivo").val(file.name);
                    });
                }
            };
            ';
        Asset::addScript($dropzone_options);
    }

}