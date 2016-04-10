<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Propuesta;
use App\Models\Image;
use App\Models\Concepto;
use Asset;

class CursosController extends Controller
{
    public function __construct(Request $request)
    {
        Asset::add('css/cursos.css');
    }

    public function getCurso($curso)
    {
        return view("site.cursos.index", [
            'curso' => $curso,
        ]);
    }

    public function getPropuestas($curso)
    {
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

    public function getImages($curso)
    {
        Asset::add("//blueimp.github.io/Gallery/css/blueimp-gallery.min.css");
        Asset::add("css/vendor/bootstrap-image-gallery.min.css");
        Asset::add("//blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js");
        Asset::add("js/vendor/bootstrap-image-gallery.min.js");

        $images = Image::whereCurso($this->fromNameToNumber($curso))->get();

        return view("site.cursos.gallery", [
            'curso' => $curso,
            'images' => $images,
        ]);
    }

    public function getGlosario($curso)
    {
        $conceptos = Concepto::whereCurso($this->fromNameToNumber($curso))->get();

        return view("site.cursos.glossary", [
            'curso' => $curso,
            'conceptos' => $conceptos,
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
