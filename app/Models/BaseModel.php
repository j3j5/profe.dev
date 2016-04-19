<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Acetone;

class BaseModel extends Model
{
    /**
     * Boot function
     */
    public static function boot()
    {
        parent::boot();

        self::saved( function($concepto) {
            if(app()->environment("production")) {
                Acetone::banMany("/curso*");
            }
            \Log::info("Model created/updated, varnish cache deleted");
        });

        self::deleted( function($concepto) {
            if(app()->environment("production")) {
                Acetone::banMany("/curso*");
            }
            \Log::info("Model deleted, varnish cache deleted");
        });
    }
}
