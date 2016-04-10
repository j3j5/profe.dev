<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GrupoConceptos extends Model
{
    //
    public function conceptos()
    {
        return $this->hasMany(Concepto::class, 'id', 'grupo_id');
    }
}
