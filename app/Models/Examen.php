<?php

namespace App\Models;

class Examen extends BaseModel
{
    protected $guarded = ['created_at'];

    public static $rules = [
        'nombre'    => "required|string",
        'trimestre' => "integer|min:1|max:3",
        'thumbnail' => "string",
        'archivo'   => "string",
        'curso'     => "integer|min:1|max:3",
    ];

}
