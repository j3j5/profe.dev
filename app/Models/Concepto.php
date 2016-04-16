<?php

namespace App\Models;

use App\Models\BaseModel as Model;

class Concepto extends Model
{
    protected $guarded = ['created_at'];

    //
    public function grupo()
    {
        return $this->belongsTo(GrupoConcepto::class, 'grupo_id');
    }
}
