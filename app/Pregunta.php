<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    protected $fillable = [ 'pregunta', 'practica' ];

    protected $casts = [
        'practica' => 'boolean',
    ];

    public function respuestas()
    {
        return $this->hasMany(App\Respuesta::class);
    }
}
