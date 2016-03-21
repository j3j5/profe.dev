<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Propuesta;
use Asset;

class CursosController extends Controller
{
    public function __construct(Request $request)
    {
        Asset::add('css/curso.css');
    }

    public function getCurso($curso) {

        return view("site.cursos.index", [
            'curso' => $curso,
        ]);
    }

    public function getPropuestas($curso) {
        Asset::add('css/propuestas.css');
        $propuestas = Propuesta::whereCurso($this->fromNameToNumber($curso))->get();

        foreach ($propuestas as &$propuesta) {
            $propuesta->contenidos = explode(",", $propuesta->contenidos);
        }
        return view("site.cursos.propuestas", [
            'curso' => $curso,
            'propuestas' => $propuestas,
        ]);
    }

    private function fromNumberToName($curso)
    {
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
        return $name;
    }

    private function fromNameToNumber($name)
    {
        switch (mb_strtolower($name)) {
            case "primero":
                $number = 1;
                break;
            case "segundo":
                $number = 2;
                break;
            case "tercero":
                $number = 3;
                break;
            default:
                break;
        }
        return $number;
    }
}
