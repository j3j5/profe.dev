<?php

namespace App\Models;

use App\Models\BaseModel as Model;

class GrupoConcepto extends Model
{
    protected $guarded = ['created_at'];

    //
    public function conceptos()
    {
        return $this->hasMany(Concepto::class, 'id', 'grupo_id');
    }
}
