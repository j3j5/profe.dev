<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Respuesta extends Model
{
    protected $fillable = [ 'texto', 'practica' ];

    protected $casts = [
    'practica' => 'boolean',
    ];

    public function respuestas()
    {
        return $this->hasMany(App\Respuesta::class);
    }
}
