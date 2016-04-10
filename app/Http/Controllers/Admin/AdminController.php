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

class AdminController extends Controller
{

    protected $b2client;

    public function __construct() {
        $this->b2client = new Client(new Credentials(config('b2client.account_id'), config('b2client.app_key')));
    }

    public function imageUpload(Request $request) {
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

    protected function createAddAssets() {
        Asset::add('css/dropzone/dropzone.min.css');
        Asset::add('//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js', 'footer');
        Asset::add('js/dropzone/dropzone.min.js', 'footer');
    }

}
