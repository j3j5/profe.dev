<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Propuesta;
use Asset;

class CursosController extends Controller
{
    public function __construct()
    {
        Asset::add('css/propuestas.css');
    }

    public function getPrimero()
    {
        return $this->getCurso(1);
    }

    public function getSegundo()
    {
        return $this->getCurso(2);
    }

    public function getTercero()
    {
        return $this->getCurso(3);
    }

    private function getCurso($curso) {
        $propuestas = Propuesta::whereCurso($curso)->get();
        switch ($curso) {
            case 1:
                $name = "Primero";
                break;
            case 2:
                $name = "Segundo";
                break;
            case 3:
                $name = "Tercero";
                break;
            default:
                break;
        }
        foreach ($propuestas as &$propuesta) {
            $propuesta->contenidos = explode(",", $propuesta->contenidos);
        }
        return view("site.cursos.index", [
            'curso' => $name,
            'propuestas' => $propuestas,
        ]);
    }
}
