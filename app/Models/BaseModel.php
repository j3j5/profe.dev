<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
                // Ban varnish cache!!
            }
            \Log::info("Model created/updated, varnish cache deleted");
        });

        self::deleted( function($concepto) {
            if(app()->environment("production")) {
                // Ban varnish cache!!
            }
            \Log::info("Model deleted, varnish cache deleted");
        });
    }
}
