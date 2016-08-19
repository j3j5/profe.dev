<?php

namespace App\Models;

class GrupoConcepto extends BaseModel
{
    protected $guarded = ['created_at'];

    //
    public function conceptos()
    {
        return $this->hasMany(Concepto::class, 'id', 'grupo_id');
    }

    public static function bootstrap($controller)
    {

    }
}
