<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Propuesta;

class CursosController extends Controller
{
    public function getPrimero()
    {

    }

    public function getSegundo()
    {
        return $this->getCurso(2);
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
        return view("site.cursos.index", [
            'curso' => $name,
            'propuestas' => $propuestas,
        ]);
    }
}
