<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Propuesta;
use App\Models\Image;
use App\Models\Concepto;
use App\Models\MeGusta;
use App\Models\Examen;
use Asset;

class CursosController extends Controller
{
    public function __construct(Request $request)
    {
        parent::__construct();
    }

    public function getCurso($curso)
    {
        view()->share('title', ucfirst($curso));

        return view("site.cursos.index", [
            'cursoNr' => $this->fromNameToNumber($curso),
            'curso' => $curso,
        ]);
    }

    public function getPropuestas($curso)
    {
        view()->share('title', "Propuestas de " . ucfirst($curso));

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
        view()->share('title', "Galería de " . ucfirst($curso));

        $this->addGalleryAssets();

        $images = Image::whereCurso($this->fromNameToNumber($curso))->get();

        return view("site.cursos.gallery", [
            'curso' => $curso,
            'images' => $images,
        ]);
    }

    public function getGlosario($curso)
    {
        view()->share('title', "Glosario de " . ucfirst($curso));

        $secciones_id = Concepto::whereCurso($this->fromNameToNumber($curso))->groupBy('grupo_id')->get(['grupo_id']);
        $secciones = [];
        $secciones_id->each( function($item, $key) use(&$secciones) {
            $secciones[$item->grupo->id] = ['nombre' =>$item->grupo->nombre];
        });

        $conceptos = Concepto::whereCurso($this->fromNameToNumber($curso))->orderBy('grupo_id')->get();
        foreach ($conceptos as $concepto) {
            $secciones[$concepto->grupo_id]['conceptos'][] = $concepto;
        }


        return view("site.cursos.glossary", [
            'secciones' => $secciones,
            'curso'     => $curso,
            'empty'     => $conceptos->isEmpty(),
        ]);
    }

    public function getLikes($curso)
    {
        view()->share('title', "\"Me Gustas\" de " . ucfirst($curso));
        $this->addGalleryAssets();

        $titles = MeGusta::whereCurso($this->fromNameToNumber($curso))->groupBy('titulo')->distinct()->get();
        $likes = MeGusta::whereCurso($this->fromNameToNumber($curso))->get();

        return view('site.cursos.megustas', [
            'curso'     => $curso,
            'titulos'    => $titles,
            'likes'     => $likes,
        ]);

    }

    public function getExamenes($curso)
    {
        view()->share('title', "Examenes de " . ucfirst($curso));

        $examenes = Examen::whereCurso($this->fromNameToNumber($curso))->get();

//         foreach ($examenes as &$examen) {
//             $examen->contenidos = explode(",", $propuesta->contenidos);
//         }
        return view("site.cursos.propuestas", [
            'curso' => $curso,
            'propuestas' => $examenes,
        ]);
    }

    public function getAcreditaciones($curso)
    {
        return view('site.cursos.acreditaciones', ['curso' => 'segundo']);
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

    private function addGalleryAssets()
    {
        Asset::add("//blueimp.github.io/Gallery/css/blueimp-gallery.min.css");
        Asset::add("css/vendor/bootstrap-image-gallery.min.css");
        Asset::add("//blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js");
        Asset::add("js/vendor/bootstrap-image-gallery.min.js");
        Asset::addScript(file_get_contents(public_path("js/gallery.js")));
    }
}
