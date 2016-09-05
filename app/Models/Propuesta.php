<?php

namespace App\Models;

use Validator;

class Propuesta extends BaseModel
{
    protected $guarded = ['created_at'];

    public static $rules = [
        'nombre'        => 'required|string',
        'contenidos'    => 'string',
        'curso'         => 'integer|min:1|max:3',
        'thumbnail'     => 'string',
        'archivo'       => 'string',
    ];

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
}
