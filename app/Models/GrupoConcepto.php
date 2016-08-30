<?php

namespace App\Models;

use Validator;

class GrupoConcepto extends BaseModel
{
    protected $guarded = ['created_at', 'updated_at'];
    protected $hidden = ['created_at', 'updated_at'];

    public static $rules = ['nombre' => 'required|string'];

    //
    public function conceptos()
    {
        return $this->hasMany(Concepto::class, 'id', 'grupo_id');
    }

}
