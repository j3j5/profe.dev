<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Concepto extends Model
{
    //
    public function grupo()
    {
        return $this->belongsTo(GrupoConceptos::class, 'grupo_id');
    }
}
