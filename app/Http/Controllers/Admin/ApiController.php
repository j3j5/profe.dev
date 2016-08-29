<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\Propuesta;
use iansltx\B2Client\Client;
use iansltx\B2Client\Credentials;

class ApiController extends Controller
{
    private $b2client;

    public function __construct()
    {
        $this->b2client = new Client(new Credentials(config('b2client.account_id'), config('b2client.app_key')));
    }

    public function getTableValues($table)
    {
        $columns = array_values(array_where(\Schema::getColumnListing($table), function ($item, $key) {
            return !in_array($item, ['id', 'updated_at']);
        }));

        $values = \DB::table($table)->get();

        $response = ['columns' => $columns, 'values' => $values];

        return response()->json($response);
    }

    public function create($table, Request $request)
    {
        switch ($table) {
            case 'propuestas':
            case 'images':
            default:
                $model_name = "App\Models\\".Str::studly(Str::singular($table));
                $new = $model_name::validateAndCreate($request->input());
                break;
        }
        if(!isset($new['error'])) {
            return response()->json($new);
        } else {
            return response()->json($new, 400);
        }
    }

    public function delete($table, $id, Request $request)
    {
        dd($request->input('id'));
        $model = "App\Models\\" . Str::studly(Str::singular($table));
        $model::where('id', $request->input('id'))->first()->delete();
        return response()->json(['result' => 'success']);
    }

    public function update(Request $request, $tableName, $id)
    {
        $model = "App\Models\\" . Str::studly(Str::singular($tableName));
        if (class_exists($model)) {
            $element = $model::where('id', $id)->first();
            $element->update($request->input());
        } else {
            \DB::table($tableName)->where('id', $id)->update($request->input());
        }

        return response()->json($element);
    }

    public function thumbUpload(Request $request)
    {
        $file = array('file' => $request->file('file'));
        $rules = array('file' => 'required|mimes:JPG,jpg,JPEG,jpeg,bmp,png',); //mimes:jpeg,bmp,png and for max size max:10000
        $validator = Validator::make($file, $rules);
        if ($validator->fails()) {
            // send back to the page with the input data and errors
            return response()->json(['validationError' => $validator->errors()], 400);
        } else {
            // checking file is valid.
            if ($request->file('file')->isValid()) {
                $this->handleUpload($request);
                // sending back with message
                return response()->json(['result' => 'success']);
            } else {
                // sending back with error message.
                return response()->json(['error' => 'Not a valid file.'], 400);
            }
        }
    }

    public function galleryUpload(Request $request)
    {
        $file = array('file' => $request->file('file'));
        $rules = array('file' => 'required|mimes:JPG,jpg,JPEG,jpeg,bmp,png',); //mimes:jpeg,bmp,png and for max size max:10000
        $validator = Validator::make($file, $rules);
        if ($validator->fails()) {
        //     // send back to the page with the input data and errors
            return response()->json(['validationError' => $validator->errors()], 400);
        } else {
            // checking file is valid.
            if ($request->file('file')->isValid()) {
                $this->handleUpload($request, true);
                // sending back with message
                return response()->json(['result' => 'success']);
            } else {
                // sending back with error message.
                return response()->json(['error' => 'Not a valid file.'], 400);
            }
        }
    }

    public function uploads($table, Request $request)
    {
        $file = array('file' => $request->file('file'));
        $rules = array('file' => 'required',); //mimes:jpeg,bmp,png and for max size max:10000
        $validator = Validator::make($file, $rules);
        if ($validator->fails()) {
            // send back to the page with the input data and errors
            return response()->json(['error' => $validator->errors()], 400);
        } else {
            // checking file is valid.
            if ($request->file('file')->isValid()) {
                $this->handleUpload($request);

                // sending back with message
                return response()->json(['result' => 'success']);
            } else {
                // sending back with error message.
                return response()->json(['error' => 'Not a valid file.']);
            }
        }
    }

    private function handleUpload(Request $request, $gallery = false)
    {
        if ($gallery) {
            $destination_path = 'images/galeria/' . $request->input("curso"); // upload path
        } else {
            $destination_path = 'uploads'; // upload path
        }
        $filename = $request->file('file')->getClientOriginalName();

        if (app()->environment('production')) {
            $response = $this->b2client->uploadContents(
                config('b2client.bucket_id'),
                "$destination_path/$filename",
                file_get_contents($request->file('file')->getRealPath())
            );
            // Delete the file from the server
            unlink($request->file('file')->getRealPath());
        } else {
            $request->file('file')->move($destination_path, $filename); // uploading file to given path
        }
    }
}