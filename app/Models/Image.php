<?php

namespace App\Models;

use App\Models\BaseModel as Model;
use Validator;

class Image extends Model
{

    protected $guarded = ['created_at'];

    public static $rules = [
        "titulo"    => "required|string",
        "artista"   => "required|string",
        "año"       => "integer",
        "archivo"   => "string",
        "prueba"    => 'string'
    ];

    public static function bootstrap($controller)
    {
        if(app()->environment('production')) {
            $controller->images_base_url = "https://f001.backblaze.com/file/" . config('b2client.bucket_name') . "/images/galeria/1/";
        } else {
            $controller->images_base_url = "http://{$_SERVER['HTTP_HOST']}/images/galeria/1/";
        }
    }

    public static function boot()
    {
        parent::boot();

        self::saving(function ($image) {
            if($image->prueba) {
                $image->prueba = date('Y');
            }
            if (empty($image->curso)) {
                $image->curso = 1;
            }
        });
    }

    public static function validateAndCreate($input)
    {
        $validator = Validator::make($input, self::$rules);

        if ($validator->fails()) {
            // send back to the page with the input data and errors
            return response()->json(['error' => $validator->errors()], 400);
        } else {
            return self::create($input);
        }
    }

    public static function getVisibleColumns()
    {
        return ['titulo', 'artista', 'año', 'nombre-archivo', 'prueba'];
    }
}
