<?php

namespace App\Models;
use Validator;

class MeGusta extends BaseModel
{
    protected $guarded = ['created_at'];

    protected $cast = [
        'featured' => 'boolean'
    ];

    public static $rules = [
        'titulo'        => 'string',
        'autor'         => 'string',
        'curso'         => 'integer|min:1|max:3',
        'imagen'        => 'required|string',
    ];

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            if (empty($model->curso)) {
                $model->curso = 1;
            }
        });
    }

    public static function validateAndCreate($input)
    {
        $validator = Validator::make($input, self::$rules);

        if ($validator->fails()) {
            // send back to the page with the input data and errors
            return ['error' => $validator->errors()];
        } else {
            return self::create($input);
        }
    }

    public static function getVisibleColumns()
    {
        return ['titulo', 'autor', 'curso', 'imagen'];
    }

}
