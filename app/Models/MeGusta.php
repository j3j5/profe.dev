<?php

namespace App\Models;

class MeGusta extends BaseModel
{
    protected $guarded = ['created_at'];

    protected $cast = [
        'featured' => 'boolean'
    ];

    public static function getVisibleColumns()
    {
        return ['titulo', 'autor', 'curso', 'imagen'];
    }

}
