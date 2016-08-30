<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Acetone;
use Validator;

class BaseModel extends Model
{

    public static $rules;

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

    public static function validateAndCreate($input)
    {
        $validator = Validator::make($input, static::$rules);

        if ($validator->fails()) {
            // send back to the page with the input data and errors
            return ['error' => $validator->errors()];
        } else {
            return self::create($input);
        }
    }
}
