<?php

namespace App\Models;

use App\Models\BaseModel as Model;

class Image extends Model
{

    protected $guarded = ['created_at'];

    public static function bootstrap($controller)
    {
        if(app()->environment('production')) {
            $controller->images_base_url = "https://f001.backblaze.com/file/" . config('b2client.bucket_name') . "/images/galeria/1/";
        } else {
            $controller->images_base_url = "http://{$_SERVER['HTTP_HOST']}/images/galeria/1/";
        }
    }
}
