<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Input;
use Validator;
use Response;

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
        $parent_view = app()->make('VivifyIdeas\AdminPanelGenerator\Http\Controllers\MainController')->callAction('create', ['propuestas']);
        $data = $parent_view->getData();
        return view('admin.propuestas', $data);
    }

    public function upload() {
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
                $extension = Input::file('file')->getClientOriginalExtension(); // getting image extension
                $filename = rand(11111,99999).'.'.$extension; // renameing image

                Input::file('file')->move($destination_path, $filename); // uploading file to given path

                // sending back with message
                return Response::json('success', 200);
            }
            else {
                // sending back with error message.
                return Response::json('error', 400);
            }
        }
    }

}
