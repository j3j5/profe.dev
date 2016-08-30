<?php

namespace App\Models;

class Concepto extends BaseModel
{
    protected $guarded = ['created_at'];

    public static $rules = [
        'palabra' => 'required|string',
        'definicion' => 'string',
        'curso' => 'required|integer|min:1|max:3',
        'thumbnail' => 'string',
        'grupo_id' => 'exists:grupo_conceptos,id'
    ];

    //
    public function grupo()
    {
        return $this->belongsTo(GrupoConcepto::class, 'grupo_id');
    }

}
