<?php

namespace App\Models;

class Concepto extends BaseModel
{
    protected $guarded = ['created_at'];

    //
    public function grupo()
    {
        return $this->belongsTo(GrupoConcepto::class, 'grupo_id');
    }

}
