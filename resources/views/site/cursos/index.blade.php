@extends('site.layouts.master')
<?php use App\Models\MeGusta;
use App\Models\Examen;
?>
@section('content')

    @include('site.partials._cursos-header')
    <div class="container">
        <div class="text-center row">
            <a href="{{ route("Propuestas", [$curso]) }}">
                <div class="col-md-4 container-seccion">
                    <div class="curso-seccion">
                        <p>Propuestas</p>
                    </div>
                </div>
            </a>
            <a href="{{ route("Gallery", [$curso]) }}">
                <div class="col-md-4 container-seccion">
                    <div class="curso-seccion">
                        <p>Galería</p>
                    </div>
                </div>
            </a>
            <a href="{{ route("Glossary", [$curso]) }}">
                <div class="col-md-4 container-seccion">
                    <div class="curso-seccion">
                        <p>Glosario</p>
                    </div>
                </div>
            </a>
            @if(Examen::whereCurso($cursoNr)->exists())
            <a href="{{ route("Examenes", [$curso]) }}">
                <div class="col-md-4 container-seccion">
                    <div class="curso-seccion">
                        <p>Exámenes</p>
                    </div>
                </div>
            </a>
            @endif

            @if(request()->is("curso/primero"))
            <a href="{{ route("Prueba", [$curso]) }}">
                <div class="col-md-4 container-seccion">
                    <div class="curso-seccion">
                        <p>Prueba</p>
                    </div>
                </div>
            </a>
            @endif

            @if(request()->is("curso/segundo"))
            <a href="https://f001.backblaze.com/file/profemariana/uploads/SIMULACROS+2%C2%B0.pdf">
                <div class="col-md-4 container-seccion">
                    <div class="curso-seccion">
                        <p>Simulacros</p>
                    </div>
                </div>
            </a>
            <a href="{{ route("acreditaciones", [$curso]) }}">
                <div class="col-md-4 container-seccion">
                    <div class="curso-seccion">
                        <p>Acreditaciones</p>
                    </div>
                </div>
            </a>
            @endif

            @if(MeGusta::whereCurso($cursoNr)->exists())
            <a href="{{ route("Megustas", [$curso]) }}">
                <div class="col-md-offset-4 col-md-4 container-seccion">
                    <div class="curso-seccion">
                        <p>Me Gusta</p>
                    </div>
                </div>
            </a>
        </div> <!--  content row    -->
            @endif
    </div> <!--  container    -->
@stop
