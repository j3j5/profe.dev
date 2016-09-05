<?php namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Asset;

class MainController extends Controller {

    protected $images_base_url;
    protected $files_base_url;
    protected $create_model_url;
    protected $edit_base_url;
    protected $delete_base_url;
    protected $available_models = [
        'propuestas'    => 'propuestas',
        'images'        => 'galería' ,
        'conceptos'     => 'conceptos',
        'me_gustas'     => 'me gustas',
        'examens'       => 'exámenes',
    ];
    protected $model;

    public function __construct()
    {
        Asset::add("js/app.js");
        Asset::add("css/app.css");

        $this->images_base_url = $this->getUploadsBaseUrl().'uploads/';
        $this->files_base_url = $this->getUploadsBaseUrl().'uploads/';

        view()->share('models', $this->available_models);
    }

    public function index(Request $request, $table)
    {
        $model = str_singular(ucfirst(camel_case($table)));
        $model = "App\Models\\$model";

        if ($table == 'images') {
            $this->images_base_url = $this->getUploadsBaseUrl()."images/galeria/1/";
        }

        $js_variables = "var IMG_BASE_URL = \"{$this->images_base_url}\";";
        $js_variables .= PHP_EOL . "var FILES_BASE_URL = \"{$this->files_base_url}\";";
        Asset::addScript($js_variables, 'footer');

        switch ($table) {
            case 'me_gustas':
                return view('main.index-gallery', [
                    'model' => $table
                ]);
            default:
                return view('main.index-table', [
                    'model' => $table,
                ]);
        }

    }

    private function getUploadsBaseUrl()
    {
        if(app()->environment('production')) {
            return "https://f001.backblaze.com/file/" . config('b2client.bucket_name');
        } else {
            return "http://{$_SERVER['HTTP_HOST']}/";
        }
    }
}
