<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $parent_view = app()->make(MainController::class)->callAction('index', [$this->model, $request]);
        return $parent_view;
    }

    public function create(Request $request)
    {
        $this->createAddAssets();
        $parent_view = app()->make(MainController::class)->callAction('create', [$this->model]);
        $data = $parent_view->getData();
        if(isset($this->uploadRoute) && !empty($this->uploadRoute)) {
            $data = array_merge($data, ['uploadRoute' => $this->uploadRoute]);
        }
        return view("admin.{$this->model}.create", $data);
    }

    public function edit($id, Request $request)
    {
        $this->createAddAssets();
        $parent_view = app()->make('MainController')->callAction('edit', [$this->model, $id]);
        $data = $parent_view->getData();
        if(isset($this->uploadRoute) && !empty($this->uploadRoute)) {
            $data = array_merge($data, ['uploadRoute' => $this->uploadRoute]);
        }
        return view("admin.{$this->model}.edit", $data);
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

    /**
     * Move the uploaded file to a desired destination, CDN on production, uploads folder on dev.
     */
    protected function handleUpload(Request $request)
    {
        $destination_path = 'uploads'; // upload path
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

    protected function createAddAssets() {
        Asset::add('css/dropzone/dropzone.min.css');
        Asset::add('//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js', 'footer');
        Asset::add('js/dropzone/dropzone.min.js', 'footer');
    }

}
